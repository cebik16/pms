<?php
    namespace app\models;
    
    use Yii;
    use yii\base\Model;
    use app\models\User;
    use yii\web\UploadedFile;


    /**
     * Signup form
     * @var UploadedFile
     */
    class SignupForm extends Model
    {
        public $username;
        public $email;
        public $password;
        public $firstName;
        public $lastName;
        public $avatar;
    
    
        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                ['username', 'trim'],
                ['username', 'required'],
                ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
                ['username', 'string', 'min' => 2, 'max' => 50],
                
                ['email', 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'string', 'max' => 50],
                ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
                
                ['password', 'required'],
                ['password', 'string', 'min' => 6],
    
                ['firstName', 'trim'],
                ['firstName', 'required'],
                ['firstName', 'string'],
    
                ['firstName', 'trim'],
                ['lastName', 'required'],
                ['lastName', 'string'],
                
                ['avatar', 'image', 'on'=>'update', 'extensions' => 'jpg, gif, png'],
            ];
        }
        
        /**
         * Signs user up.
         *
         * @return bool whether the creating new account was successful and email was sent
         */
        public function signup()
        {
            if (!$this->validate()) {
                return null;
            }
            
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->firstName = $this->firstName;
            $user->lastName = $this->lastName;
            $user->avatar = $this->avatar;
            $user->status = 10;
//            $this->avatar->saveAs('uploads/' . $this->avatar->baseName . '.' . $this->avatar->extension);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
//	        var_dump($user->username);exit;
	
	        return $user->save(); //&& $this->sendEmail($user);
            
        }
        
        /**
         * Sends confirmation email to user
         * @param User $user user model to with email should be send
         * @return bool whether the email was sent
         */
        protected function sendEmail($user)
        {
            return Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                    ['user' => $user]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($this->email)
                ->setSubject('Account registration at ' . Yii::$app->name)
                ->send();
        }
    }
