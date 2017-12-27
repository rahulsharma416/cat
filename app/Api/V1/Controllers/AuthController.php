<?php

public function signup(Request $request)
{
    $signupFields = Config::get('boilerplate.signup_fields');
    $hasToReleaseToken = Config::get('boilerplate.signup_token_release');

    $userData = $request->only($signupFields);

    $validator = Validator::make($userData, Config::get('boilerplate.signup_fields_rules'));

    if($validator->fails()) {
        throw new ValidationHttpException($validator->errors()->all());
    }

    User::unguard();
    $user = User::create($userData);
    User::reguard();

    if(!$user->id) {
        return $this->response->error('could_not_create_user', 500);
    }

    if($hasToReleaseToken) {
        return $this->login($request);
    }
    
    return $this->response->created();
}
?>