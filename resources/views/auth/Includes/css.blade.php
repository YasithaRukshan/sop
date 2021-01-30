<style>
    /** register-section **/
    .page-title {
        padding: 60px 0px 60px 0px;
    }

    .lightnewHeader {
        background: #fff !important;
    }

    .topdecor {
        background-image: url("{{asset('PublicArea/images/icons/decor-3.png')}}");
    }

    .auth-header {
        background-image: none;
    }

    .auth-form-area {
        background-image: url("{{asset('PublicArea/images/shape/shape-48.png')}}");
    }

    @media only screen and (max-width: 599px) {
        .mbnScrolled .menu-area .mobile-nav-toggler {
            background-color: #fff;
        }

        .mbnScrolled .menu-area .mobile-nav-toggler .icon-bar {
            background: #1d165c !important;
        }

    }

    .colornewdark {
        background: #1d165c !important;
    }

     .content-box #register-form,
    .contact-section.style-two  .content-box .auth-form {
        padding: 50px 20px;
    }

     .content-box .auth-form .form-group input:focus,
     .content-box .auth-form .form-group textarea:focus {
        border-color: #7302ea !important;
    }

    .contact-section.alternate-2 .content-box .auth-form .form-group input:focus,
    .contact-section.alternate-2 .content-box .auth-form .form-group textarea:focus,
    .contact-section.alternate-3  .content-box .auth-form .form-group input:focus,
    .contact-section.alternate-3 .content-box .auth-form .form-group textarea:focus {
        border-color: #00032b !important;
    }

     .content-box .auth-form {
        position: relative;
        display: block;
        background: #fff;
        padding: 56px 40px 60px 40px;
        border-radius: 5px;
        box-shadow: 0 0px 50px rgba(2, 13, 49, 0.2);
    }

     .content-box #register-form:before {
        position: absolute;
        content: '';
        background: #fff;
        width: 100%;
        height: calc(100% - 40px);
        left: 20px;
        top: 20px;
        z-index: -1;
        border-radius: 5px;
        box-shadow: 0 0px 50px rgba(2, 13, 49, 0.2);
    }

     .content-box .auth-form .form-group {
        position: relative;
        margin-bottom: 26px;
    }

     .content-box .auth-form .form-group:last-child {
        margin-bottom: 0px;
    }

     .content-box .auth-form .form-group label {
        position: relative;
        display: block;
        font-size: 16px;
        font-family: 'Josefin Sans', sans-serif;
        color: #1d165c;
        font-weight: 600;
        margin-bottom: 13px;
    }

     .content-box .auth-form .form-group label i {
        font-size: 14px;
        color: #7f7f7f;
        margin-right: 10px;
    }

     .content-box .auth-form .form-group input[type='text'],
     .content-box .auth-form .form-group input[type='email'],
     .content-box .auth-form .form-group input[type='number'],
     .content-box .auth-form .form-group input[type='tel'],
     .content-box .auth-form .form-group textarea {
        position: relative;
        width: 100%;
        height: 55px;
        border: 1px solid #e5e5e5;
        border-radius: 3px;
        padding: 10px 20px;
        font-size: 16px;
        font-style: italic;
        transition: all 500ms ease;
    }

     .content-box .auth-form .form-group input:focus,
     .content-box .auth-form .form-group textarea:focus {}

     .content-box .auth-form .form-group textarea {
        display: block;
        height: 120px;
        resize: none;
        margin-bottom: 4px;
    }

     .content-box .auth-form .form-group button {
        display: block;
        width: 100%;
    }

    .main-header.style-five .main-menu .navigation>li>a {
        color: #ffffff;
    }

    .main-header.style-five .sticky-header .navigation>li>a {
        color: #1d165c;
    }

     .content-box .auth-form .form-group input[type='password'] {
        position: relative;
        width: 100%;
        height: 55px;
        border: 1px solid #e5e5e5;
        border-radius: 3px;
        padding: 10px 20px;
        font-size: 16px;
        font-style: italic;
        transition: all 500ms ease;
    }


    .error {
        color: red !important;
        margin-top: 10px;
    }

    .termpolicy {
        margin-top: -5px;
        margin-left: 6px;
    }

    .checkbox {
        margin-left: 2px;
    }

    .page-title.style-two {
        background: #fff !important;
    }

    .main-header.style-five .main-menu .navigation>li>a {
        color: #1d165c;
    }

    label#agreePolicy-error {
        display: none !important;
    }

    #agreePolicy {
        margin: 0px !important;
    }

    #inpRef {
        margin: 0px !important;
    }

</style>
