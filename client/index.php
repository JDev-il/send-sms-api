<?php 
include_once '../server/db/connection.php';
include_once './twilio.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/png" sizes="16x16" href="css/img/NLwebsiteFL2-min.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link rel="stylesheet" href="css/custom.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>        
        <script src="js/functions.js"></script>
        <title>SMS Sending | network-leads.com</title>
    </head>
    <body>

      <?php
      
      /* PHP Variables
      -------------------------------------------------- */
      $page_header_title = "SMS SYSTEM";
      $page_header_paragraph = "by Jonathan Daniel"; 
      
      /* End of PHP Variables
      -------------------------------------------------- */
    
    ?>        

      <div>
        <header class="header">
        <?php             
            echo "<div class='_headerBg'>
                  <img src='./css/img/phone.png'>
              </div>
              <div class='headerContent'>
                <h1>{$page_header_title}</h1>
                <p>{$page_header_paragraph}</p>
              </div>";
          ?>
        </header>
        <section>
        <?php 
          if(isset($_POST['submit'])){
            ?>            
            <h6 class='text-center mt-5' style='margin-top: 15px; margin-bottom: 0; color: red;' id="fail">
              <?php if($GLOBALS['error'] !== ''){ echo $GLOBALS['error']; } ?>
            </h6>
            <h6 class='text-center mt-5' style='margin-top: 15px; margin-bottom: 0; color: green;' id="success">
              <?php if($GLOBALS['msg'] !== ''){ echo $GLOBALS['msg']; } ?>
            </h6>               
            <?php
          }
          ?>
           <?php
            include_once './features/smsbutton.php';
            include_once './features/table.php';
          ?>
        </section>
      </div>
        <div class='modal fade' id='smsModal' tabindex='-1' role='dialog' aria-labelledby='smsModalLable' aria-hidden='true'>
          <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                  <div class='modal-body'>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                  &times;
                  </button>
                      <form class='form-group' action='./index.php' method='post' name="form" id='contactForm'>
                          <div class='form-group'>
                              <label for='from'>From Number:</label>
                              <input class='form-control' type='text' id='fromnum' name='fromnum' value="(+12) 06-737-38-27">
                          </div>
                          <div class='form-group'>
                          <label for='to' id="recieveCountriesName">Your Number:</label>
                            <div class="countryNumber">
                              <select style='width: 80px' class="recieveCountries form-control" type='select' id='countrycode' name='countrycode' required>
                              </select>
                              <input class='form-control' type='text' id='tonum' name='tonum' maxlength='10' required>
                            </div>
                          </div>
                          <div class='form-group'>
                              <label for='message'>Message:</label>
                              <textarea class='form-control' name='message' id='message' rows='10' placeholder='Enter text..' required></textarea>
                          </div>
                          <div class='form-froup'>
                          <button type='submit' name='submit' class='btn' id="formSubmit">Send SMS</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          
      </div>
    </body>
</html>




