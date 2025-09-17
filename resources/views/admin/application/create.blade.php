<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>{{ $applicationSetting->title ?? $title }}</title>
    
    @include('admin.layouts.common.header_script')

    <!-- Wizard css -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/pages/wizard.css') }}">

    <style type="text/css" media="screen">
        .inner {
            margin: 0 auto;
            width: 100%;
            height: auto;
            overflow: hidden;
            clear: both;
        }
        .inner img {
            margin: 0 auto;
            max-width: 100%;
            width: auto;
            height: auto;
            overflow: hidden;
        }
    </style>

</head>

<body>

@isset($applicationSetting)
<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="card">
            <div class="card-block">
                <div class="row mt-5 mb-5">
                    <div class="col-sm-2">
                        <div class="inner text-center">
                            @if(is_file('uploads/application-setting/'.$applicationSetting->logo_left))
                            <img src="{{ asset('uploads/application-setting/'.$applicationSetting->logo_left) }}" class="img-fluid" alt="Logo">
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-8 text-center">
                        <h2>{{ $applicationSetting->title }}</h2>
                        <p>{!! strip_tags($applicationSetting->body, '<br><b><i><strong><u><a><span><del>') !!}</p>
                    </div>
                    <div class="col-sm-2">
                        <div class="inner text-center">
                            @if(is_file('uploads/application-setting/'.$applicationSetting->logo_right))
                            <img src="{{ asset('uploads/application-setting/'.$applicationSetting->logo_right) }}" class="img-fluid" alt="Logo">
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Success Alert --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <i class="fas fa-check-double"></i> {{ trans_choice('module_application', 1) }} {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <!-- [ Card ] start -->
            <div class="col-sm-12">
                <div class="card">
                    @php
                        function field($slug){
                            return \App\Models\Field::field($slug);
                        }
                    @endphp
                    <div class="wizard-sec-bg">
                    <form id="wizard-advanced-form" class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                        <h3>{{ __('tab_basic_info') }}</h3>
                        <content class="form-step">
                            <!-- Form Start -->
                            <div class="row">
                            <div class="col-md-12">
                            <fieldset class="row scheduler-border">
                            <div class="form-group col-md-6">
                                <label for="first_name">{{ __('field_first_name') }} <span>*</span></label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_first_name') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="last_name">{{ __('field_last_name') }} <span>*</span></label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_last_name') }}
                                </div>
                            </div>

                            

                            <div class="form-group col-md-6">
                                <label for="phone">{{ __('field_phone') }} <span>*</span></label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_phone') }}
                                </div>
                            </div> 

                            <div class="form-group col-md-6">
                                <label for="email">{{ __('field_email') }} <span>*</span></label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_email') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="gender">{{ __('field_gender') }} <span>*</span></label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="">{{ __('select') }}</option>
                                    <option value="1" @if( old('gender') == 1 ) selected @endif>{{ __('gender_male') }}</option>
                                    <option value="2" @if( old('gender') == 2 ) selected @endif>{{ __('gender_female') }}</option>
                                    <option value="3" @if( old('gender') == 3 ) selected @endif>{{ __('gender_other') }}</option>
                                </select>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_gender') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="dob">{{ __('field_dob') }} <span>*</span></label>
                                <input type="date" class="form-control date" name="dob" id="dob" value="{{ old('dob') }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_dob') }}
                                </div>
                            </div>

                            @if(field('application_emergency_phone')->status == 1)
                            <div class="form-group col-md-6">
                                <label for="emergency_phone">{{ __('field_emergency_phone') }}</label>
                                <input type="text" class="form-control" name="emergency_phone" id="emergency_phone" value="{{ old('emergency_phone') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_emergency_phone') }}
                                </div>
                            </div>
                            @endif

                            @if(field('application_religion')->status == 1)
                            <div class="form-group col-md-6">
                                <label for="religion">{{ __('field_religion') }}</label>
                                <input type="text" class="form-control" name="religion" id="religion" value="{{ old('religion') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_religion') }}
                                </div>
                            </div>
                            @endif

                            @if(field('application_caste')->status == 1)
                            <div class="form-group col-md-6">
    <label for="caste">{{ __('field_caste') }}</label>
    <div>
        <label for="yes" class="me-3">
            <input type="radio" name="caste" value="yes" id="yes" {{ old('caste') == 'yes' ? 'checked' : '' }} required> {{ __('Yes') }}
        </label>
        <label for="no">
            <input type="radio" name="caste" value="no" id="no" {{ old('caste') == 'no' ? 'checked' : '' }} required> {{ __('No') }}
        </label>
    </div>

    <div class="invalid-feedback">
      {{ __('required_field') }} {{ __('field_caste') }}
    </div>
</div>

                            @endif

                            @if(field('application_mother_tongue')->status == 1)
                            <div class="form-group col-md-6">
                                <label for="mother_tongue">{{ __('field_mother_tongue') }}</label>
                                <input type="text" class="form-control" name="mother_tongue" id="mother_tongue" value="{{ old('mother_tongue') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_mother_tongue') }}
                                </div>
                            </div>
                            @endif

                            @if(field('application_nationality')->status == 1)
                            <div class="form-group col-md-6">
                                <label for="nationality">{{ __('field_nationality') }}</label>
                                <input type="text" class="form-control" name="nationality" id="nationality" value="{{ old('nationality') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_nationality') }}
                                </div>
                            </div>
                            @endif

                            @if(field('application_marital_status')->status == 1)
                            <div class="form-group col-md-6">
                                <label for="marital_status">{{ __('field_marital_status') }}</label>
                                <select class="form-control" name="marital_status" id="marital_status">
                                    <option value="">{{ __('select') }}</option>
                                    <option value="1" @if( old('marital_status') == 1 ) selected @endif>{{ __('marital_status_single') }}</option>
                                    <option value="2" @if( old('marital_status') == 2 ) selected @endif>{{ __('marital_status_married') }}</option>
                                    <option value="3" @if( old('marital_status') == 3 ) selected @endif>{{ __('marital_status_widowed') }}</option>
                                    <option value="4" @if( old('marital_status') == 4 ) selected @endif>{{ __('marital_status_divorced') }}</option>
                                    <option value="5" @if( old('marital_status') == 5 ) selected @endif>{{ __('marital_status_other') }}</option>
                                </select>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_marital_status') }}
                                </div>
                            </div>
                            @endif

                            @if(field('application_blood_group')->status == 1)
                            <div class="form-group col-md-6">
                                <label for="blood_group">{{ __('field_blood_group') }}</label>
                                <select class="form-control" name="blood_group" id="blood_group">
                                    <option value="">{{ __('select') }}</option>
                                    <option value="1" @if( old('blood_group') == 1 ) selected @endif>{{ __('A+') }}</option>
                                    <option value="2" @if( old('blood_group') == 2 ) selected @endif>{{ __('A-') }}</option>
                                    <option value="3" @if( old('blood_group') == 3 ) selected @endif>{{ __('B+') }}</option>
                                    <option value="4" @if( old('blood_group') == 4 ) selected @endif>{{ __('B-') }}</option>
                                    <option value="5" @if( old('blood_group') == 5 ) selected @endif>{{ __('AB+') }}</option>
                                    <option value="6" @if( old('blood_group') == 6 ) selected @endif>{{ __('AB-') }}</option>
                                    <option value="7" @if( old('blood_group') == 7 ) selected @endif>{{ __('O+') }}</option>
                                    <option value="8" @if( old('blood_group') == 8 ) selected @endif>{{ __('O-') }}</option>
                                </select>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_blood_group') }}
                                </div>
                            </div>
                            @endif

                            @if(field('application_national_id')->status == 1)
                            <div class="form-group col-md-6">
                                <label for="national_id">{{ __('field_national_id') }}</label>
                                <input type="text" class="form-control" name="national_id" id="national_id" value="{{ old('national_id') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_national_id') }}
                                </div>
                            </div>
                            @endif

                            @if(field('application_passport_no')->status == 1)
                            <div class="form-group col-md-6">
                                <label for="passport_no">{{ __('field_passport_no') }}</label>
                                <input type="text" class="form-control" name="passport_no" id="passport_no" value="{{ old('passport_no') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_passport_no') }}
                                </div>
                            </div>
                            @endif
                            </fieldset>
                            </div>
                            </div>

                            @if(field('application_address')->status == 1)
                            <div class="row">
                              <div class="col-md-6">
                                <fieldset class="row scheduler-border">
                                <legend>{{ __('field_present') }} {{ __('field_address') }}</legend>
                                

                                <div class="form-group col-md-12">
                                    <label for="present_address">{{ __('field_address') }}</label>
                                    <input type="text" class="form-control" name="present_address" id="present_address" value="{{ old('present_address') }}">

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_address') }}
                                    </div>
                                </div>
                                </fieldset>
                              </div>

                              <div class="col-md-6">
                                <fieldset class="row scheduler-border">
                                <legend>{{ __('field_permanent') }} {{ __('field_address') }}</legend>
                                

                                <div class="form-group col-md-12">
                                    <label for="permanent_address">{{ __('field_address') }}</label>
                                    <input type="text" class="form-control" name="permanent_address" id="permanent_address" value="{{ old('permanent_address') }}">

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_address') }}
                                    </div>
                                </div>
                                </fieldset>
                              </div>
                            </div>
                            @endif

                            <fieldset class="row scheduler-border">
                            <legend>{{ __('field_academic_information') }}</legend>
                            <div class="form-group col-md-6">
                            <label for="program">{{ __('First Choice') }} <span>*</span></label>
                                <select class="form-control program" name="program" id="program" required>
                                  <option value="">{{ __('select') }}</option>
                                  @foreach( $programs as $program )
                                    <option value="{{ $program->id }}" @if(old('program') == $program->id) selected @endif>{{ $program->title }}</option>
                                  @endforeach
                                </select>

                              <div class="invalid-feedback">
                                {{ __('required_field') }} {{ __('field_program==') }}
                              </div>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="program">{{ __('Second Choice') }} <span>*</span></label>
                                <select class="form-control program" name="program" id="program" required>
                                  <option value="">{{ __('select') }}</option>
                                  @foreach( $programs as $program )
                                    <option value="{{ $program->id }}" @if(old('program') == $program->id) selected @endif>{{ $program->title }}</option>
                                  @endforeach
                                </select>

                              <div class="invalid-feedback">
                                {{ __('required_field') }} {{ __('field_program') }}
                              </div>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="program">{{ __('Third Choice') }} <span>*</span></label>
                                <select class="form-control program" name="program" id="program" required>
                                  <option value="">{{ __('select') }}</option>
                                  @foreach( $programs as $program )
                                    <option value="{{ $program->id }}" @if(old('program') == $program->id) selected @endif>{{ $program->title }}</option>
                                  @endforeach
                                </select>

                              <div class="invalid-feedback">
                                {{ __('required_field') }} {{ __('field_program') }}
                              </div>
                            </div>
                            </fieldset>
                            <!-- Form End -->
                        </content>

                        <!-- Add Empty Tabs Below Here -->

                        <h3>{{ __('ADDRESSES') }}</h3>
                        <content class="form-step">
                            <!-- Empty Tab: ADDRESSES -->
                        </content>

                        <h3>{{ __('ACADEMIC OBJECTIVES') }}</h3>
                        <content class="form-step">
                            <!-- Empty Tab: ACADEMIC OBJECTIVES -->
                        </content>

                        <h3>{{ __('LANGUAGES') }}</h3>
                        <content class="form-step">
                             <div style="font-size: 1.5em; font-weight: bold; color: #1a73e8; margin-bottom: 15px;">
        5. LANGUAGES
    </div>

    <div style="font-size: 1em; margin-bottom: 10px;">
        <label for="language_instructions" style="font-weight: bold;">
            Was English the language of instruction at the secondary/high school(s) you attended? <span style="font-weight: normal;">Yes</span>
            <input type="radio" name="language_instructions" value="yes" style="margin-left: 10px;">
            <span style="font-weight: normal;">No</span>
            <input type="radio" name="language_instructions" value="no" style="margin-left: 10px;">
            <span style="font-weight: normal;">If NO, identify the language of instruction at these schools:</span>
            <input type="text" name="language_of_instruction" style="margin-left: 10px;">
        </label>
    </div>

    <div style="font-size: 1em; margin-top: 15px;">
        <label for="other_languages" style="font-weight: bold;">Indicate any other language(s) spoken:</label>
        <table id="languagesTable" style="width: 100%; margin-top: 10px; border-collapse: collapse; text-align: left;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Language</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Years of Study</th>
                    <th colspan="4" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Fluency</th>
                </tr>
                <tr>
                    <th colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;"></th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Excellent</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Good</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Fair</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Minimal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <input type="text" name="language_1" style="width: 100%;">
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <input type="text" name="years_of_study_1" style="width: 100%;">
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                        <input type="radio" name="fluency_1" value="excellent">
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                        <input type="radio" name="fluency_1" value="good">
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                        <input type="radio" name="fluency_1" value="fair">
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                        <input type="radio" name="fluency_1" value="minimal">
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Button to add a new row -->
        <button type="button" onclick="addRow()" style="margin-top: 20px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Add New Row
        </button>
    </div>

    <div style="font-size: 1em; margin-top: 20px;">
        <label for="english_proficiency" style="font-weight: bold;">English Proficiency:</label>
        <p style="font-size: 0.95em; font-weight: normal;">
            Applicants from a non-English speaking background who have passed “A” Level Examinations or equivalent will be required to demonstrate proficiency in the English language, by sitting and passing an English Language Test.
        </p>
    </div>
                        </content>

                        <h3>{{ __('SUPPORTING DOCUMENTS (Admission Requirements)') }}</h3>
                        <content class="form-step">
                            <div style="font-size: 1.5em; font-weight: bold; color: #1a62e8ff;">
        6. SUPPORTING DOCUMENTS (Admission Requirements):
    </div>
    <ul style="font-size: 1em; margin-left: 20px;">
        <li style="margin-bottom: 5px;">1) A Receipt of Registration Fee of Fifteen thousand (15,000) francs paid into the Catholic University of Cameroon (CATUC) Bamenda Bank Account with either OPSECS (100446), ECOBANK (0200122608355201), Union Bank of Cameroon (UBC: 00111013204), United Bank of Africa (UBA: 040500000060), National Financial Credit (NFC: 17301022306), or SGBC (05160250250-22).</li>
        <li style="margin-bottom: 5px;">2) One Clean Photocopy of Birth Certificate</li>
        <li style="margin-bottom: 5px;">3) One Clean Photocopy of GCE O'Level or Probaoire Certificate</li>
        <li style="margin-bottom: 5px;">4) One Clean Photocopy of GCE A'Level or Baccalaureate Certificate</li>
        <li style="margin-bottom: 5px;">5) 1,000frs for Colour Passport Size Photograph (hard & soft taken on campus)</li>
        <li style="margin-bottom: 5px;">6) Students with foreign certificates should present Equivalences to their certificates obtained from the Ministry of Higher Education (MINESUP), Yaoundé.</li>
    </ul>
                        </content>

                        <h3>{{ __('DECLARATION') }}</h3>
                        <content class="form-step">
                            <!-- Empty Tab: DECLARATION -->
                        </content>

                        

                    </form>
                    </div>

                </div>
            </div>
            <!-- [ Card ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->
@endisset

    
    @include('admin.layouts.common.footer_script') 


    <!-- validate Js -->
    <script src="{{ asset('dashboard/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>

    <!-- Wizard Js -->
    <script src="{{ asset('dashboard/js/pages/jquery.steps.js') }}"></script>

    <script type="text/javascript">
        "use strict";
        var form = $("#wizard-advanced-form").show();

        form.steps({
            headerTag: "h3",
            bodyTag: "content",
            transitionEffect: "slideLeft",
            labels: 
            {
                finish: "{{ __('btn_finish') }}",
                next: "{{ __('btn_next') }}",
                previous: "{{ __('btn_previous') }}",
            },
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Always allow previous action even if the current form is not valid!
                if (currentIndex > newIndex)
                {
                    return true;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex)
            {
                
            },
            onFinishing: function (event, currentIndex)
            {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                $("#wizard-advanced-form").submit();
            }
        }).validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {

            }
        });
    </script>
    <script>
        function addRow() {
            var table = document.getElementById("languagesTable");
            var row = table.insertRow(table.rows.length - 1); // Insert before the last row (the header)
            
            // Insert new cells in the row
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);

            // Add inputs for the new row
            cell1.innerHTML = '<input type="text" name="language_' + (table.rows.length - 2) + '" style="width: 100%;">';
            cell2.innerHTML = '<input type="text" name="years_of_study_' + (table.rows.length - 2) + '" style="width: 100%;">';
            cell3.innerHTML = '<input type="radio" name="fluency_' + (table.rows.length - 2) + '" value="excellent">';
            cell4.innerHTML = '<input type="radio" name="fluency_' + (table.rows.length - 2) + '" value="good">';
            cell5.innerHTML = '<input type="radio" name="fluency_' + (table.rows.length - 2) + '" value="fair">';
            cell6.innerHTML = '<input type="radio" name="fluency_' + (table.rows.length - 2) + '" value="minimal">';
        }
    </script>

</body>
</html>
