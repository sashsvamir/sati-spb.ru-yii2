/**
 * Require:
 * - jquery
 * - bower/tingle
 */
(() => {



	const config = {
		buttonId: '#feedback-form-widget',
		//url: 'https://intermehanika-ltd.ru/feedback/frame/index',
		//url: 'http://shop/feedback/frame/index',
		modalClass: 'modal-feedback-form',
		buttonClass: 'modal-feedback-control',
		//offsetTarget: '#nav',
	};
	//console.log( $(config.buttonId).data('offset-element') );
	config.offsetTarget = $(config.buttonId).data('offset-target');





	/**
	 * Button class
	 */
	class Button {
		constructor(config, modal) {
			this.url = config.url;
			this.offsetTarget = document.querySelector(config.offsetTarget);
			this.createButton(config.buttonClass);
			this.attachScrollHandler(this.offsetTarget);
			this.attachClickHandler();
			this.modal = modal;
		}

		createButton(buttonClass) {
			// instead creation we get already button rendered from yii wiget
			this.button = document.querySelector('.' + buttonClass);
		}

		// todo: replace jquery by native js
		show() {
			$(this.button).fadeIn();
		}
		hide() {
			$(this.button).fadeOut();
		}

		// Move button on scroll (make stiky)
		attachScrollHandler(offsetTarget) {
			if (offsetTarget === null) {
				return false;
			}

			const _this = this;
			window.onscroll = function() {
				window.scrollY = window.scrollY || window.document.body.scrollTop; // fix ie9 missing scrollY param
				const rect = offsetTarget.getBoundingClientRect();
				let targetPos = {
					//right: window.innerWidth - (rect.left + rect.width),
					top: rect.height + (rect.top + window.scrollY),
				};
				//console.log(rect);

				// если скролл ниже чем меню
				if (window.scrollY > targetPos.top) {
					_this.show();
				} else {
					_this.hide();
				}

				// make sticky
				targetPos.top = targetPos.top - window.scrollY;
				if (targetPos.top > 0) {
					_this.button.style.top = targetPos.top + 'px'; /* right: targetPos.right*/
				} else {
					_this.button.style.top = 0;
				}
			};
		}

		// Open modal with form on button click
		attachClickHandler() {
			const self = this;
			const button = this.button;
			button.addEventListener('click', (e) => {
				e.preventDefault();

				if (self.modal.isLoaded()) {
					self.modal.show();
					return;
				}

				const url = button.getAttribute('data-url');
				self.modal.loadData( url ).show();
			});
		}

	}













	/**
	 * Modal class (require tingle)
	 */
	class Modal {
		constructor(modalClass) {
			// create remodal
			this.modal = new tingle.modal({
				closeMethods: ['overlay', 'button', 'escape'],
				cssClass: [modalClass],
				closeLabel: 'Закрыть',
			});
			this.loaded = false;
		}

		setLoaded(state) {
			this.loaded = state;
			return this;
		}
		isLoaded() {
			return this.loaded;
		}

		show() {
			this.modal.open();
			return this;
		}
		hide() {
			this.modal.close();
			return this;
		}

		loadData(url) {
			if (url) {
				this.setBody(url);
				this.setLoaded(true);
			}
			return this;
		}

		setBody(url) {
			// create iframe
			let iframe = document.createElement('iframe');
			iframe.className = 'frame-feedback';
			iframe.setAttribute('src', url);
			let wrapper = document.createElement('div');
			wrapper.className = 'frame-wrapper';
			wrapper.appendChild(iframe);

			// set iframe
			this.modal.setContent(wrapper);

			// set ajax loading class (remove on load iframe content)
			wrapper = this.modal.getContent().querySelector('.frame-wrapper');
			wrapper.classList.add('ajax-loading');
			iframe = wrapper.querySelector('iframe');
			iframe.onload = function() {
				wrapper.classList.remove('ajax-loading');
			};

			return this;
		}

		getBody() {
			return this.modal.modalBoxContent;
		}
	}










	new Button(config, new Modal(config.modalClass));



})();

