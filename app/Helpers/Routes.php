<?php
class Routes {

    private static $base = 'dashboard.';
    //auth
    private static $auth = self::$base.'auth.';
    public static $loginPage = self::$auth.'sign-in';
    public static $registerPage = self::$auth.'sign-up';
    public static $forgotPage = self::$auth.'forgot-password';
    public static $editProfilePage = self::$auth.'edit-profile';
    public static $changePasswordPage = self::$auth.'reset-password';
    public static $verifyEmailPage = self::$auth.'verify-email';

    //dash
    public static $profilePage = self::$base.'profile';
}
