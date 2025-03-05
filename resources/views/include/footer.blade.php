<style>
    .popup-overlay_pdf {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .popup_pdf-content {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        margin-left: 600px;
        margin-top: 200px;
        /* Responsive width */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    }

    #pdfButtons button {
        margin: 5px;
    }
</style>

<div id="pdfPopup" class="popup-overlay_pdf">
    <div class="popup_pdf-content">
        <h4>Download Your Application PDF</h4>
        <div id="pdfButtons"></div>
        <button id="closePopup" class="btn btn-danger mt-2">Close</button>
    </div>
</div>


<div class="footer-bottom">
    <div class="auto-container">

        <div class="wrapper-box">
            <div class="row text-center">
                <div class="col-lg-12  text-center">

                    <!-- <div class="col-lg-2 col-md-2 col-12"></div> -->
                    <div class="col-lg-12 col-md-8 col-12  ">
                        <i class="fa fa-file "></i> <a rel="noopener" href="websitepolicies.php"> Website Policies </a><span>
                            | </span>

                        <i class="fa fa-question"></i><a rel="noopener" href="#"> Help </a>
                        <span>|</span>

                        <i class="fa fa-comment"></i> <a rel="noopener" href="niot_feedback.php"> Feedback </a>
                        <span>|</span>

                        <i class="fa fa-id-badge"></i> <a rel="noopener" href="#" onclick="set_session_home_menu('','','niot_contactus.php')"> Contact Us</a>

                    </div>
                    <!-- <div class="col-lg-2 col-md-2 col-12"></div> -->
                </div>
            </div>

            <div class="col-lg-12 pt-2">
                <div class="  text-center middleContent text-white"> © Content Owned and Maintained by Tamilnadu Electrical Licensing Board (TNELB), <br> Website Designed and Developed By<a rel="noopener" href="http://www.nic.in/" target="blank" class="external_link pt-2"> National Informatics Centre (NIC) </a>,
                    <a rel="noopener" href="http://meity.gov.in/" target="blank" class="external_link pt-2"> Ministry of Electronics &amp; Information Technology</a>, Government of India
                </div>
            </div>
            <div class="copyright">
                <div class="text">© <script>
                        document.write(new Date().getFullYear());
                    </script> <a href="#">TNELB</a> - All rights reserved.
                </div>
            </div>
        </div>
    </div>
</div>
</footer>
</div>
</div>
<!--End pagewrapper-->


<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon-arrow"></span></div>

<script src="{{ url('assets/js/jquery.js') }}"></script>
<script src="{{ url('assets/js/popper.min.js') }}"></script>
<script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ url('assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ url('assets/js/isotope.js') }}"></script>
<script src="{{ url('assets/js/owl.js') }}"></script>
<script src="{{ url('assets/js/appear.js') }}"></script>
<script src="{{ url('assets/js/wow.js') }}"></script>
<script src="{{ url('assets/js/lazyload.js') }}"></script>
<script src="{{ url('assets/js/scrollbar.js') }}"></script>
<script src="{{ url('assets/js/TweenMax.min.js') }}"></script>
<script src="{{ url('assets/js/swiper.min.js') }}"></script>
<script src="{{ url('assets/js/jquery.polyglot.language.switcher.js') }}"></script>
<script src="{{ url('assets/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ url('assets/js/parallax-scroll.js') }}"></script>

<script src="{{ url('assets/js/script.js') }}"></script>
<!-- --------------------------------------------------------------- -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.2.2/mixitup.min.js'></script>
<!-- fancybox -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.js'></script>
<!-- Fancybox js -->
<script>
    /*Downloaded from https://www.codeseek.co/ezra_siton/mixitup-fancybox3-JydYqm */
    // 1. querySelector
    var containerEl = document.querySelector(".portfolio-item");
    // 2. Passing the configuration object inline
    //https://www.kunkalabs.com/mixitup/docs/configuration-object/
    var mixer = mixitup(containerEl, {
        animation: {
            effects: "fade translateZ(-100px)",
            effectsIn: "fade translateY(-100%)",
            easing: "cubic-bezier(0.645, 0.045, 0.355, 1)"
        }
    });
    // fancybox insilaze & options //
    $("[data-fancybox]").fancybox({
        loop: true,
        hash: true,
        transitionEffect: "slide",
        /* zoom VS next////////////////////
        clickContent - i modify the deafult - now when you click on the image you go to the next image - i more like this approach than zoom on desktop (This idea was in the classic/first lightbox) */
        clickContent: function(current, event) {
            return current.type === "image" ? "next" : false;
        }
    });
</script>


<script>
    $('a[data-toggle="formtab"]').click(function() {
        event.preventDefault();
        var targetId = $(this).attr('href');

        $('.tabs-panels').removeClass('active')
        $('a[data-toggle="formtab"]').removeClass('active');

        $(targetId).addClass('active');
        $('a[href="' + targetId + '"]').addClass('active')



    });
</script>
<!-- 
<script>
    $('a[data-toggle="formtab"]').click(function (event) {
        event.preventDefault(); // Prevent default anchor click behavior
        var targetId = $(this).attr('href'); // Get the target tab's ID

        // Remove active class from all tabs and links
        $('.tabs-panels').removeClass('active');
        $('a[data-toggle="formtab"]').removeClass('active');

        // Add active class to the clicked tab and its corresponding content
        $(targetId).addClass('active');
        $('a[href="' + targetId + '"]').addClass('active');
    });
</script> -->

<script>
    // JavaScript to ensure footer is at the bottom
    function setFooterPosition() {
        const body = document.body;
        const html = document.documentElement;
        const wrapper = document.querySelector('.page-wrapper');
        const footer = document.querySelector('.footer-bottom');

        // Reset height to auto before recalculating
        wrapper.style.minHeight = '500';

        // Calculate height of visible content
        const contentHeight = Math.max(
            body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight
        );

        // Adjust wrapper height
        if (contentHeight < window.innerHeight) {
            wrapper.style.minHeight = `${window.innerHeight}px`;
        }
    }

    // Run on load and resize
    window.addEventListener('load', setFooterPosition);
    window.addEventListener('resize', setFooterPosition);
</script>

<script>
    $(document).ready(function() {
        $("#form1").submit(function(event) {


            event.preventDefault();

            $("#PhoneNoError").text("");
            $("#EmailError").text("");

            let name = $("#Name").val().trim();
            let gender = $("input[name='gender']:checked").val();
            let phone = $("#PhoneNo").val().trim();

            let email = $("#EmailAddress").val().trim();
            let address = $("#Address").val().trim();
            let state = $("#state").val();
            let district = $("#district").val();
            let pincode = $("#pincode").val().trim();
            let errors = [];



            if (name === "") errors.push("Name is required.");
            if (!gender) errors.push("Gender is required.");
            // if (phone === "") errors.push("Phone no is required.");
            if (!/^\d{10}$/.test(phone)) errors.push("Enter a valid 10-digit mobile number.");
            if (!/^[6-9]\d{9}$/.test(phone)) {
                errors.push("Enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.");
            }

            if (email !== "" && !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) errors.push("Enter a valid email.");
            if (address === "") errors.push("Address is required.");
            if (state === "") errors.push("Select a state.");
            if (district === "") errors.push("Select a district.");
            if (!/^\d{6}$/.test(pincode)) errors.push("Enter a valid 6-digit pincode.");

            if (errors.length > 0) {
                alert(errors.join("\n"));
                return;
            }
            //  alert('after_error');
            // alert(name + ', ' + gender + ', ' + phone + ', ' + email + ', ' + address + ', ' + state + ', ' + district + ', ' + pincode);
            let formData = {
                _token: "{{ csrf_token() }}",
                Name: name,
                gender: gender,
                PhoneNo: phone,
                EmailAddress: email,
                Address: address,
                state: state,
                district: district,
                pincode: pincode
            };

            console.log("Submitting data:", formData);

            $.ajax({
                type: "POST",
                url: "{{ route('register.store') }}",
                data: formData,
                // success: function(response) {
                //     console.log("Response:", response.success);
                //     return false;
                //     if (response.success) {
                //         $("#success-popup").fadeIn();
                //         $("#overlay").fadeIn();
                //     } else {
                //         alert("Registration failed.");
                //     }
                // },
                success: function(response) {
                    console.log("Response:", response);

                    if (response.success) {
                        $("#login-id-display").text(response.login_id);
                        $("#success-popup").fadeIn();
                        $("#overlay").fadeIn();
                    }
                },
                error: function(xhr) {
                    let response = xhr.responseJSON;
                    if (response && response.errors) {
                        if (response.errors.PhoneNo) {
                            $("#PhoneNoError").text(response.errors.PhoneNo[0]); // Show error under mobile number field
                        }
                        if (response.errors.EmailAddress) {
                            $("#EmailError").text(response.errors.EmailAddress[0]); // Show error under email field
                        }
                    }
                }
            });
        });

        $(".log_in").click(function() {
            console.log("Submitting data:");

            window.location.href = "{{ route('login') }}";
        });

    });


    $(document).ready(function() {
        $("#login-form").submit(function(event) {
            event.preventDefault(); // Prevent form submission

            let phone = $("#phone").val().trim();
            let captcha = $("input[name='captcha']").val().trim();
            let errors = [];



            // if (phone === "" || !/^\d{10}$/.test(phone)) {
            //     errors.push("Enter a valid 10-digit mobile number.");
            // }

            if (captcha === "") {
                errors.push("CAPTCHA is required.");
            }

            if (errors.length > 0) {
                alert(errors.join("\n"));
                return;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('login.check') }}", // Laravel route
                data: {
                    _token: "{{ csrf_token() }}",
                    phone: phone,
                    captcha: captcha
                },
                success: function(response) {
                    if (response.success) {
                        // alert("Login successful!");
                        // window.location.href = "/dashboard";

                        $("#otp-overlay").fadeIn();
                        $("#overlay-bg").fadeIn();
                    }
                },
                error: function(xhr) {
                    let response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        $("#phone").after('<span class="text-danger">' + response.message + '</span>'); // Show error below input
                    } else {
                        alert("An error occurred. Please try again.");
                    }
                }
            });
        });



        // Refresh CAPTCHA
        $("#refresh-captcha").click(function(event) {
            event.preventDefault();
            $("#image-captcha").attr("src", "{{ url('captcha/image') }}?rand=" + Math.random());
        });
    });

    let profile = document.querySelector('.profile');
    let menu = document.querySelector('.menu');

    profile.onclick = function() {
        menu.classList.toggle('active');
    }
</script>

<script>
    $(document).ready(function() {
        $("#add-more-education").click(function() {
            // Clone the last set of education fields
            let newFields = $(".education-fields").last().clone();

            // Clear input values inside the cloned fields
            newFields.find("input").val("");
            newFields.find("select").prop("selectedIndex", 0);

            // Append cloned fields to the container
            $("#education-container").append(newFields);
        });
    });
</script>


<script>
    $(document).ready(function() {
        $("#add-more-work").click(function() {
            // Clone the last work fields section
            let newFields = $(".work-fields").last().clone();

            // Clear input values
            newFields.find("input").val("");
            newFields.find("input[type='checkbox']").prop("checked", false);

            // Append cloned fields to the container
            $("#work-container").append(newFields);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#saveDraftBtn, #submitPaymentBtn').on('click', function(e) {
            e.preventDefault(); // Prevent default form submission

            $('.error-message').remove(); // Clear previous error messages
            let isValid = true;

            // Validate at least one education row exists
            if ($('#education-container .education-fields').length === 0) {
                $('#education-table').after('<span class="error-message text-danger d-block mt-1">At least one educational qualification is required.</span>');
                $('html, body').animate({
                    scrollTop: $('#education-table').offset().top - 50
                }, 500);
                return;
            }

            let fathersName = $('#Fathers_Name').val().trim();
            if (fathersName === "") {
                $('#Fathers_Name').after('<span class="error-message text-danger d-block mt-1">Father\'s Name is required.</span>');
                isValid = false;
            }

            // Validate Date of Birth
            let dob = $('#d_o_b').val();
            if (dob === "") {
                $('#d_o_b').after('<span class="error-message text-danger d-block mt-1">Date of Birth is required.</span>');
                isValid = false;
            }

            if (!$('#declarationCheckbox').is(':checked')) {
                $('#checkboxError').show();
                isValid = false;
            } else {
                $('#checkboxError').hide();
            }
            let photoInput = $('#upload_photo')[0];
            if (photoInput.files.length === 0) {
                $('#upload_photo').after('<span class="error-message text-danger d-block mt-1">Photo upload is required.</span>');
                isValid = false;
            } else {
                let file = photoInput.files[0];
                let allowedTypes = ["image/jpeg", "image/png"];

                if (!allowedTypes.includes(file.type)) {
                    $('#upload_photo').after('<span class="error-message text-danger d-block mt-1">Only JPG and PNG images are allowed.</span>');
                    isValid = false;
                }

                // if (file.size > 150 * 1024) {
                //     $('#upload_photo').after('<span class="error-message text-danger d-block mt-1">File size must not exceed 150KB.</span>');
                //     isValid = false;
                // }
            }

            // Validate each education row
            $('#education-container .education-fields').each(function() {
                let eduLevel = $(this).find('select[name="educational_level[]"]');
                let instituteName = $(this).find('input[name="institute_name[]"]');
                let yearOfPassing = $(this).find('select[name="year_of_passing[]"]');
                let percentage = $(this).find('input[name="percentage[]"]');
                let documentUpload = $(this).find('input[name="education_document[]"]');

                if (eduLevel.val() === null) {
                    eduLevel.after('<span class="error-message text-danger d-block mt-1">Please select education level.</span>');
                    isValid = false;
                }

                if (instituteName.val().trim() === "") {
                    instituteName.after('<span class="error-message text-danger d-block mt-1">Institution name is required.</span>');
                    isValid = false;
                }

                if (yearOfPassing.val() === "0") {
                    yearOfPassing.after('<span class="error-message text-danger d-block mt-1">Please select a valid year of passing.</span>');
                    isValid = false;
                }

                if (percentage.val().trim() === "" || isNaN(percentage.val()) || percentage.val() < 0 || percentage.val() > 100) {
                    percentage.after('<span class="error-message text-danger d-block mt-1">Enter a valid Percentage /Grade.</span>');
                    isValid = false;
                }

                // if (documentUpload.val() === "") {
                //     documentUpload.after('<span class="error-message text-danger d-block mt-1">Please upload a document.</span>');
                //     isValid = false;
                // }
            });

            //     if ($('#work-container .work-fields').length === 0) {
            //     $('#work-table').after('<span class="error-message text-danger d-block mt-1">At least one work experience entry is required.</span>');
            //     $('html, body').animate({
            //         scrollTop: $('#work-table').offset().top - 50
            //     }, 500);
            //     return;
            // }

            // // Validate each work experience row
            // $('#work-container .work-fields').each(function() {
            //     let companyName = $(this).find('input[name="work_level[]"]');
            //     let experienceYears = $(this).find('input[name="experience[]"]');
            //     let designation = $(this).find('input[name="Designation[]"]');
            //     let documentUpload = $(this).find('input[name="work_document[]"]');

            //     if (companyName.val().trim() === "") {
            //         companyName.after('<span class="error-message text-danger d-block mt-1">Company name is required.</span>');
            //         isValid = false;
            //     }

            //     if (experienceYears.val().trim() === "" || isNaN(experienceYears.val()) || experienceYears.val() <= 0) {
            //         experienceYears.after('<span class="error-message text-danger d-block mt-1">Enter a valid number of years.</span>');
            //         isValid = false;
            //     }

            //     if (designation.val().trim() === "") {
            //         designation.after('<span class="error-message text-danger d-block mt-1">Designation is required.</span>');
            //         isValid = false;
            //     }

            //     if (documentUpload.val() === "") {
            //         // documentUpload.after('<span class="error-message text-danger d-block mt-1">Please upload an experience certificate.</span>');
            //         // isValid = false;
            //     } else {
            //         let file = documentUpload[0].files[0];
            //         let allowedTypes = ["application/pdf", "image/png"];
            //         if (!allowedTypes.includes(file.type) || file.size > 100 * 1024) {
            //             documentUpload.after('<span class="error-message text-danger d-block mt-1">Only PDF or PNG files under 100KB are allowed.</span>');
            //             isValid = false;
            //         }
            //     }
            // });

            if (!isValid) {
                return; // Stop form submission if validation fails
            }

            let actionType = $(this).attr('id') === 'saveDraftBtn' ? "draft" : "payment";
            let formData = new FormData($('#competency_form_ws')[0]);
            formData.append('form_action', actionType);

            $.ajax({
                url: "/form/store",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#saveDraftBtn, #submitPaymentBtn').prop('disabled', true);
                },
                success: function(response) {
                    alert(response.message);

                    if (response.login_id) {
                        $('#pdfButtons').html(`
                            <button class="btn btn-primary" onclick="downloadPDF('english', '${response.login_id}')">Download Your Application in English PDF</button>
                            <button class="btn btn-success" onclick="downloadPDF('tamil', '${response.login_id}')">Download Your Application in Tamil PDF</button>
                        `);

                        // Show the popup
                        $('#pdfPopup').fadeIn();
                    }

                    $('#saveDraftBtn, #submitPaymentBtn').prop('disabled', false);
                },
                error: function(xhr) {
                    $('#saveDraftBtn, #submitPaymentBtn').prop('disabled', false);

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(field, messages) {
                            let inputField = $('[name="' + field + '"]');
                            inputField.closest('.col-12').append('<span class="error-message text-danger d-block mt-1">' + messages[0] + '</span>');
                        });

                        $('html, body').animate({
                            scrollTop: $('.error-message:first').offset().top - 50
                        }, 500);
                    } else {
                        alert("An error occurred: " + xhr.responseText);
                    }
                }
            });
        });

        $('#closePopup').on('click', function() {
            $('#pdfPopup').fadeOut(function() {
                window.location.href = "/dashboard"; // Redirect to the dashboard page after the popup fades out
            });
        });
    });




    function downloadPDF(language, loginId) {
        let url = (language === 'tamil') ? `/generateTamilPDF/${loginId}` : `/generate-pdf/${loginId}`;
        window.open(url, '_blank'); // Open in a new tab
    }
</script>

</body>

</html>