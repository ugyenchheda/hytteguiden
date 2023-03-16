<?php
/**
 * The main template file
 *  Template Name: Login Form
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maya_Journeys
 */

get_header();


?>
<section class="section">
  <div class="container">
    <div class="login-form">
      <h2 class="sectiontitle" style="text-align: center;"><span> Logg Inn</span></h2>
      <p class="login-text">Vennligst bruk brukernavn og passord gitt til deg for å logge inn.</p>
          <form action="" id="user_login_form">
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="login_username" id="login_username" class="form-control" placeholder="Brukernavn">
              
            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" name="login_password" id="login_password" class="form-control" placeholder="Passord">
            </div>
            <div class="remember">
              <input type="checkbox"> Remember Me
            </div>
            <div class="form-group text-center">
              <input type="submit" name="login" value="Logg Inn" class="btn login_btn">
              <div class="login_message"></div>
            </div>
            <div class="form-group text-center">
              <a href="#">Glemt passord</a> | <a href="#">Registrere</a>
            </div>
          </form>
    </div>
  </div>
</section>
<?php

get_footer();
