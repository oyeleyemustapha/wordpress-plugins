document.addEventListener('DOMContentLoaded', function() {


    
    window.addEventListener('scroll', function() {
      
      var scrollDepth = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
      if (scrollDepth >= 25) {
        
        showNewsletterPrompt();
      }
    });





    
    function showNewsletterPrompt() {
        if (getCookie("newsletter_subscription_option") == null) {
            document.querySelector('.newsletter-widget-overlay').style.display = "flex";
        }
    }

    //CLOSE NEWSLETTER PROMPT
    document.querySelector('.newletter-box .close').addEventListener('click', function() {
        document.querySelector('.newsletter-widget-overlay').style.display = "none";
        setCookie("newsletter_subscription_option", "closed", 100);
    });

    //SUBMIT USER NEWSLETTER SUBSCRIPTION
    document.querySelector('#newsletterUserSubscriptionForm').addEventListener('submit', function(e) {
        e.preventDefault();

        
        let email = document.querySelector('input[name="email"]').value;
    
        var ele = document.getElementsByName('interest');
 
            for (i = 0; i < ele.length; i++) {
                if (ele[i].checked){
                     var selectedInterests=ele[i].value;
                }
               
            }
   


        var xhr = new XMLHttpRequest();
        xhr.open('POST', punch_mailchimp_params.ajax_url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var res = xhr.responseText;
                if (res == 'You have subscribed to our newsletter') {
                    setCookie("newsletter_subscription_option", "subscribed", 100);
                    setTimeout(function() {
                        document.querySelector('.newsletter-widget-overlay').style.display = "none";
                    }, 3000);
                }
                document.querySelector('.newletter-box .msg').innerHTML = '<div class="alert alert-info mt-5"><p class="lead">' + res + '</p></div>';
                document.querySelector('.email-box button').innerHTML = 'Join Now';
                document.querySelector('.email-box button').disabled = false;
            }
        };

        var params = 'action=subscribe&security=' + punch_mailchimp_params.security + '&email=' +email +'&interests='+ selectedInterests;
        xhr.send(params);

        document.querySelector('.email-box button').innerHTML = 'Processing...';
        document.querySelector('.email-box button').disabled = true;
        
    });

    //SET COOKIE
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    //GET COOKIE
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(";");
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == " ") c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    
});
