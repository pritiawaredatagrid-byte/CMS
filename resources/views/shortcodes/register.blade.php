<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - UnifyAMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Define your custom CSS variables here for easy theming */
        :root {
            --colorGrayX11: #ccc;
            --colorSapphireBlue: #007bff; /* Bootstrap primary blue */
            --colorDarkText: #333;
            --colorLightText: #666;
            --colorBackground: #f8f9fa; /* Light grey background */
            --colorCardBackground: #ffffff;
            --colorInputBorder: #ced4da;
            --colorInputFocus: #80bdff;
            --colorButtonPrimary: #28a745; /* Green for success/continue */
            --colorButtonHover: #218838;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--colorBackground);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--colorDarkText);
        }

        /* Main Registration Container */
        .registration-container {
            background-color: var(--colorCardBackground);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px; /* Adjust max-width as needed */
            margin: 20px;
        }

        .header-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-section img.logo {
            max-width: 120px;
            margin-bottom: 20px;
        }

        .header-section h1 {
            font-size: 2.5em;
            font-weight: 700;
            color: var(--colorSapphireBlue);
            margin-bottom: 10px;
        }

        .header-section p {
            font-size: 1.1em;
            color: var(--colorLightText);
            line-height: 1.6;
        }

        /* Form Content (Member/Vendor selection) */
        .form-content {
            margin-top: 30px;
            text-align: center;
        }

        .form-content .border-box {
            border: 1px solid var(--colorGrayX11);
            border-radius: 16px;
            padding: 25px 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            position: relative; /* For custom checkbox label positioning */
        }
        
        /* Custom Checkbox Overlay */
        .form-content .border-box .form-check {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10; /* Ensure checkbox is clickable */
        }

        .form-content .border-box input[type="checkbox"] {
            /* Hide default checkbox */
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            cursor: pointer;
            z-index: 1; /* Make it clickable over content */
        }
        
        .form-content .border-box .custom-control-label {
            /* This label acts as the visual checkbox */
            width: 20px;
            height: 20px;
            border: 2px solid var(--colorGrayX11);
            border-radius: 50%;
            display: inline-block;
            position: relative;
            background-color: var(--colorCardBackground);
            z-index: 0; /* Behind the hidden input */
        }

        .form-content .border-box input[type="checkbox"]:checked + .custom-control-label {
            border-color: var(--colorSapphireBlue);
            background-color: var(--colorSapphireBlue);
        }

        .form-content .border-box input[type="checkbox"]:checked + .custom-control-label::after {
            content: '✔';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--colorCardBackground);
            font-size: 12px;
        }

        .form-content .border-box:hover {
            border-color: var(--colorSapphireBlue);
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.1);
        }

        .form-content .border-box.selected {
            border-color: var(--colorSapphireBlue);
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.2);
        }

        .form-content .icon-box {
            margin-bottom: 15px;
        }

        .form-content .icon-box img {
            max-width: 60px;
            height: auto;
        }

        .form-content h2 {
            font-size: 1.5em;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--colorDarkText);
        }

        .form-content p {
            font-size: 0.9em;
            color: var(--colorLightText);
            line-height: 1.5;
            margin-bottom: 0;
        }

        /* General Form Fields */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-control {
            height: 45px;
            border-radius: 8px;
            border: 1px solid var(--colorInputBorder);
            padding: 10px 15px;
            font-size: 1em;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .form-control:focus {
            border-color: var(--colorInputFocus);
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        .btn-primary {
            background-color: var(--colorButtonPrimary);
            border-color: var(--colorButtonPrimary);
            padding: 12px 25px;
            font-size: 1.1em;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: var(--colorButtonHover);
            border-color: var(--colorButtonHover);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.2);
        }

        /* Form Footer */
        .form-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.95em;
            color: var(--colorLightText);
        }

        .form-footer a {
            color: var(--colorSapphireBlue);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease-in-out;
        }

        .form-footer a:hover {
            text-decoration: underline;
            color: var(--colorSapphireBlue); /* Keep the blue on hover */
        }

        /* Toast Container (for messages) */
        .custom-toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: 300px;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .registration-container {
                padding: 25px;
                margin: 15px;
            }
            .header-section h1 {
                font-size: 2em;
            }
            .form-content .border-box {
                padding: 20px 15px;
            }
            .form-content h2 {
                font-size: 1.3em;
            }
            .form-footer {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>
<body>

    <div class="registration-container">
        <div class="header-section">
           
            <h1>Create Your Account! <span style="font-size: 0.8em;">✍️</span></h1>
            <p>Register to access exclusive events, member perks and connect with our vibrant community.</p>
        </div>

        <div id="i40ht" class="form-content">

            <form id="registrationForm" style="display: none;">
                <div class="form-group mt-4">
                    <label for="fullName" class="form-label visually-hidden">Full Name</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label visually-hidden">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label visually-hidden">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword" class="form-label visually-hidden">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </div>
                </div>
            </form>

            <div class="row" id="continueButtonRow">
                <div class="col-md-12 mt-4">
                    <a href="javascript:void(0)" class="btn btn-primary w-100 check_type" id="continueButton">
                        <span class="d-flex align-items-center justify-content-center h-100">Continue</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div id="iolf8c" class="form-footer d-flex gap-2 justify-content-center mt-4 mb-3">
            <p id="il56ks" class="m-0">Already having an account?</p>
            <a id="i160w6" href="{{url('/')}}/login" class="frm-footer-link link-color-blue">Login</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Your existing jQuery logic, slightly modified for the new form
        $(document).ready(function() {
            // Function to toggle selected class
            function toggleBoxSelection(checkboxId, boxSelector) {
                const isChecked = $(checkboxId).is(':checked');
                $(boxSelector).toggleClass('selected', isChecked);
            }

            // Initial state based on checkboxes
            toggleBoxSelection('#memberCheckbox', '.member-box');
            toggleBoxSelection('#vendorCheckbox', '.vendor-box');

            $('#memberCheckbox').on('change', function() {
                if (this.checked) {
                    $('#vendorCheckbox').prop('checked', false).trigger('change'); // Uncheck vendor if member is checked
                }
                toggleBoxSelection('#memberCheckbox', '.member-box');
                toggleBoxSelection('#vendorCheckbox', '.vendor-box'); // Update vendor box state
            });

            $('#vendorCheckbox').on('change', function() {
                if (this.checked) {
                    $('#memberCheckbox').prop('checked', false).trigger('change'); // Uncheck member if vendor is checked
                }
                toggleBoxSelection('#vendorCheckbox', '.vendor-box');
                toggleBoxSelection('#memberCheckbox', '.member-box'); // Update member box state
            });

            // Handle clicks on the border boxes to toggle checkboxes
            $('.member-box').on('click', function(e) {
                if (!$(e.target).is('input[type="checkbox"]')) {
                    $('#memberCheckbox').prop('checked', !$('#memberCheckbox').is(':checked')).trigger('change');
                }
            });

            $('.vendor-box').on('click', function(e) {
                if (!$(e.target).is('input[type="checkbox"]')) {
                    $('#vendorCheckbox').prop('checked', !$('#vendorCheckbox').is(':checked')).trigger('change');
                }
            });

            let alertShown = false;
            $('#continueButton').on('click', function(e) {
                e.preventDefault();

                const isMemberChecked = $('#memberCheckbox').is(':checked');
                const isVendorChecked = $('#vendorCheckbox').is(':checked');

                if (isMemberChecked) {
                    // Show common registration fields, hide continue button
                    $('#registrationForm').show();
                    $('#continueButtonRow').hide();
                    // Optionally, update form action or add a hidden input for type
                    // window.location.href = "/member-register"; // Or proceed with dynamic form
                } else if (isVendorChecked) {
                    // Show common registration fields, hide continue button
                    $('#registrationForm').show();
                    $('#continueButtonRow').hide();
                    // window.location.href = "/vendor-register"; // Or proceed with dynamic form
                } else {
                    if (!alertShown) {
                        alertShown = true;
                        // Placeholder for your flash_error or Swal.fire equivalent
                        alert('Please select either Member or Vendor to continue.'); 
                        setTimeout(() => {
                            alertShown = false;
                        }, 5000); 
                    }
                }
            });

            // Handle submission of the dynamic registration form
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault();
                alert('Registration form submitted!'); // Placeholder for AJAX submission
                // Perform AJAX submission here based on member/vendor selection
                // Example:
                // const registerType = $('#memberCheckbox').is(':checked') ? 'member' : 'vendor';
                // $.post('/api/register/' + registerType, $(this).serialize(), function(response) {
                //     console.log(response);
                // });
            });
        });
    </script>
</body>
</html>