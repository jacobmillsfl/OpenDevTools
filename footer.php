<?php
/**
 * Created by PhpStorm.
 * User: robsm_5mj
 * Date: 10/3/2017
 * Time: 9:38 AM
 *
 * Private Policy && Donation button. Author CarlaPastor. 2017
 */
?>
<!-- Footer -->
<br/><br/><br/><br/><br/><br/>
<footer class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <form class="m-0 text-center" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <!--- Identify our business so that we can collect the donations. -->
                    <input type="hidden" name="business"
                           value="opendevtools@gmail.com">

                    <!-- Specify a Donate button. -->
                    <input type="hidden" name="cmd" value="_donations">

                    <!-- Specify details about the contribution -->
                    <input type="hidden" name="item_name" value="Friends of Open Sources">
                    <input type="hidden" name="item_number" value="OpenDevTools Campaign">
                    <input type="hidden" name="currency_code" value="USD">

                    <!-- Display the payment button. -->
                    <input type="image" name="submit"
                           src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_donate_92x26.png"
                           alt="Donate">
                    <img alt="" width="1" height="1"
                         src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                </form>
            </div>
            <div class="col-lg-6 col-md-6">
                <p class="m-0 text-center text-white">Copyright &copy; opendevtools.org 2017 - <a href="/policy.php"><b>Private
                            Policy</a></p></b>
            </div>
            <div class="col-lg-3 col-md-3">
                <div id="google_translate_element"></div><script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                    }
                </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </div>





        </div>
    </div>
    <!-- /.container -->
</footer>
