<?php
/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */
class Yii extends \yii\BaseYii
{
	/**
	 * @var BaseApplication|WebApplication|ConsoleApplication the application instance
	 */
	public static $app;
}

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 * @property null $authManager The auth manager for this application. Null is returned if auth manager is not configured. This property is read-only. Extended component.
 * @property \yii\swiftmailer\Mailer $mailer The mailer component. This property is read-only. Extended component.
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property \yii\web\Response $response The response component. This property is read-only. Extended component.
 * @property \yii\web\ErrorHandler $errorHandler The error handler application component. This property is read-only. Extended component.
 *
 * Custom components:
 * @property User $user The user component. This property is read-only. Extended component.
 */
class WebApplication extends yii\web\Application
{
}

/**
 * Class ConsoleApplication
 * Include only Console application related components here
 *
 * @property \yii\console\Response $response
 * @property \yii\console\ErrorHandler $errorHandler
 */
class ConsoleApplication extends yii\console\Application
{
}

/**
 * @inheritdoc
 *
 * @property \backend\models\User|\frontend\models\User|\yii\web\IdentityInterface|null $identity The identity object associated with the currently logged-in user. null is returned if the user is not logged in (not authenticated).
 */
class User extends \yii\web\User
{
}
