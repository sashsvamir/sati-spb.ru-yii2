<?php
namespace common\models;

use yii\base\Model;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecordInterface;


/**
 *
 */
class Search extends Model
{
	// public $maxAjaxShow = 8;
	public $maxLengthQuery = 40;
	public $minLengthQuery = 2;
	public $maxLengthWord = 20;
	public $minLengthWord = 2;

	/** @var string */
	public $query;

	/** @var string */
	public $model;

	/** @var ActiveRecordInterface */
	private $_model;

	/** @var array словарь ключевых слов */
	public $dict = [];

	/** @var ActiveRecordInterface[] */
	public $models;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		// create class
		if ($this->model === null || !class_exists($this->model)) {
			throw new InvalidConfigException('You must extend Image class and set "filepath" property before using this class.');
		}
		$this->_model = new $this->model();
	}

	public function parse(string $q)
	{
		$this->query = $q;

		// Составляем словарь из слов запроса
		$this->dict = $this->getDict($this->query);

		if ($this->hasErrors()) {
			return false;
		}

		// Обрезаем окончания слов
		$this->dict = $this->shortenWords($this->dict);

		// Берем модель поиска товаров удовлетворяющих поисковым словам $dict
		$this->models = $this->loadModel($this->dict);

		return true;
	}

	/**
	 * Создаем словарь из поисковой фразы
	 */
	private function getDict(string $q) : array
	{
		// Фильтруем
		// подробнее про `\p{Cyrillic}` здесь: http://stackoverflow.com/questions/1571187/regexp-with-russian-lang
		$q = preg_replace('/[^a-zA-Z0-9 \p{Cyrillic}]/u', ' ', $q);

		// проверяем длину запроса
		if (mb_strlen($q) > $this->maxLengthQuery ||
			mb_strlen($q) < $this->minLengthQuery) {
			$this->addError('query', 'Недопустимая длина запроса');
			return [$q];
		}

		// Создаем словарь ключевых слов
		$dict = [];

		// добавляем в словарь отдельные ключевые слова, отфильтровывая пробелы
		$dict = array_filter(explode(' ', $q), 'mb_strlen');

		// удаляем дублирующиеся ключевые слова из словаря
		$dict = array_unique($dict);

		// оставляем в словаре только длинные слова
		$dict_len = array_filter($dict, function($x) {
			return mb_strlen($x) >= $this->minLengthWord;
		});

		if (empty($dict_len)) {
			$this->addError('query', 'Недопустимая длина запроса');
		}

		return $dict;
	}



	/**
	 *	Удаляем окончания в словаре (http://ruseller.com/lessons.php?rub=37&id=1264)
	 */
	private function shortenWords(array $dict) : array
	{
		$reg = '/(ый|ые|ой|ая|ое|ы|ому|а|о|у|е|ого|ему|и|ство|ых|ох|ия|ий|ь|я|он|ют|ат|ный)$/iu';

		$result = [];
		foreach ($dict as $word) {
			$short = preg_replace($reg, '', $word);

			// если слово удалилось
			if (empty($short)) {
				$short = $word;
			}

			$result[] = $short;
		}

		return $result;
	}

	/**
	 * Возвращает модель при совпадении с ключевыми запросами
	 * @param $dict array массив ключевых запросов по которым вести поиск
	 * @return Item[]
	 */
	private function loadModel(array $dict, ?int $limit = null)
	{
		$model = Item::find();

		// Формируем запрос
		foreach ($dict as $keyword) {
			// формируется запрос типа:
			// WHERE ((`t`.visible=1) AND ((translate.name LIKE '%aphe%') OR (artist.artist_name LIKE '%aphe%')) AND ((translate.name LIKE '%wind%') OR (artist.artist_name LIKE '%wind%')))
			// т.е. ((альбом = '%aphe%') OR (артист = '%aphe%') OR (описание = '%aphe%')) AND ((альбом = '%on%') OR (артист = '%on%') OR (описание = '%on%'))
			$condition[] = "("
				."	(lower(header) LIKE lower('%".$keyword."%')) OR"
				// ."	(translate.name      LIKE '%".$keyword."%') OR"
				// ."	(short_description   LIKE '%".$keyword."%') OR"
				// ."	(full_description    LIKE '%".$keyword."%') OR"
				."	(lower(body_purified) LIKE lower('%" . $keyword . "%'))"
				."	)
			";
		}

		$model->where(implode(' AND ', $condition));

		// сортируем: вначало совпадения в заголовке
		$model->orderBy("(CASE
			WHEN lower(header) LIKE lower('" . $keyword . "%') THEN 1
			WHEN lower(header) LIKE lower('%" . $keyword . "%') THEN 2
			WHEN lower(body_purified) LIKE lower('" . $keyword . "%') THEN 3
			WHEN lower(body_purified) LIKE lower('%" . $keyword . "%') THEN 4
			ELSE 5
			END), header");

		if ($limit && is_numeric($limit)) {
			$model->limit($limit);
		}

		return $model->all();
	}

	/**
	 * Выделяем текст тэгом у полученного текста
	 * @param string $text исходный текст
	 * @param array $match массив слов которые надо выделить
	 * @param string $tag тэг в который обернуть
	 * @return string
	 */
	public function bold(string $text, array $match, string $tag = 'b') : string
	{
		// Проходим по всем поисковым словам и обертываем тэгом совпадение с поисковым словом
		foreach ($match as $keyword) {
			// $text = preg_replace('/('.$keyword.')/iu', '<'.$tag.'>$1</'.$tag.'>', $text);
			$text = preg_replace('/([а-яА-Я]*'.$keyword.'[а-яА-Я]*)/iu', '<'.$tag.'>$1</'.$tag.'>', $text);
		}
		return $text;
	}

	/**
	 * Возвращаем обрезанную часть текста в которой встречается искомое слово
	 * @param string $keystack основной текст
	 * @param array $needles массив слов которые надо найти
	 * @param int $before сколько показывать символов до ключевого слова
	 * @param int $after сколько показывать символов после ключевого слова
	 * @return string
	 */
	public function text_part(string $keystack, array $needles, int $before = 80, int $after = 170)
	{
		// $needles = array('промышленные', 'остались');
		$len = mb_strlen($keystack);

		// если длина текста меньше обрезных выпусков до/после + поправочные коэффициенты
		if ($len < $before + $after + 100 + 200) {
			return $keystack;
		}

		// определим позицию искомого слова до первого вхождения
		foreach ($needles as $needle) {
			$pos = mb_strpos(mb_strtolower($keystack, 'UTF-8'), mb_strtolower($needle, 'UTF-8'));
			if ($pos) {
				break;
			}
		}

		// если слово близко к началу, не будем резать начало
		if ($pos < $before + 100) {
			$posBegin = null;
		} else {
			$posBegin = $pos - $before;
		}

		// если слово близко к концу, не будем резать конец
		if ($pos > $len - $after - 200) {
			$width = null;
		} else {
			$width = $before + $after;
		}

		// обрезаем текст в районе найденного слова
		$words = mb_substr($keystack, $posBegin, $width);

		// распределим каждое слово в массив
		$words = explode(' ', $words);

		// если позиция первых символов не в начале текста, заменим первый элемент многоточием
		if ($posBegin) {
			$words[0] = '…';
			// array_shift($words);
		}

		// если позиция последних символов не в конце текста, заменим последний элемент многоточием
		if ($width) {
			array_pop($words);
			// array_push($words, '…');
		}


		// развернем массив слов обратно в текст
		$out = implode(' ', $words);

		// если предложение было обрезано, поставим неразрывный пробел с многоточием вконце абзаца
		if ($width) {
			$out = $out . '&nbsp;…';
		}

		return $out;
	}

}
