<?php namespace Foostart\Trainer\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Company\Models\Company;
use Foostart\Trainer\Models\Trainer;
use Illuminate\Support\MessageBag as MessageBag;

class TrainerValidator extends FooValidator
{

    protected $obj_company;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'user' => ["required"],
            'company_id' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_trainer = new Trainer();

        // language
        $this->lang_front = 'trainer-front';
        $this->lang_admin = 'trainer-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'user.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.user')]),
                'company_id.required'      => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.company')]),
            ];
        });

    }

    /**
     *
     * @param ARRAY $input is form data
     * @return type
     */
    public function validate($input) {

        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs(){

        $configs = config('package-trainer');
        return $configs;
    }

}