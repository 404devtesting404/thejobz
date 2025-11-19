@extends('layouts.app')
@section('content')
    <section id="hero" class="d-flex align-items-center cus-about-us">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1 class="text-left">Property of Deceased Person</h1>
            <p class="form-sub">2021 Estate EIN and SS-4 Form</p>
        </div>
    </section><!-- End Hero -->
    <section class="contactus">
        <div class="container">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="container message" style="height: 85px; margin: 0px 0px 0px 19px; ">
                        <div class="alert-box">
                            <div class="alert alert-success">
                                <div class="alert-icon text-center">
                                    <i class="fa fa-check-square-o  fa-3x" aria-hidden="true"></i>
                                </div>
                                <div class="alert-message text-center">
                                    <strong>Success!</strong> Form Submitted.
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- .........................Owner Information............................... -->
                <!-- form open -->
                <form action="{{ route('formsubmit_two') }}" method="post">
                    @csrf
                    <input value="Property of Deceased Person" name="mailtitle" style="display: none">
                    <ul class="cus-formcontainer">
                        <li class="cus-form-hd">
                            <h2 class="gsection_title">Deceased Individual Information</h2>
                            <input name="<h2>Deceased_Individual_Information</h2>" value="*" style="display: none">
                        </li>
                        <li class="form-li">
                            <label class="cus-form-label" for="">First Name of Deceased <span
                                    class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="First_Name_of_Deceased:" class="first_name" id="" type="text" value=""
                                    aria-required="true" aria-invalid="false" required>
                            </div>
                        </li>
                        <li class="form-li">
                            <label for="" class="cus-form-label">Middle Name of Deceased </label>
                            <div class="input-con">
                                <input name="Middle_Name_of_Deceased:" class="middle_name" id="" type="text" value=""
                                    aria-invalid="false">
                            </div>
                        </li>

                        <li class="form-li">
                            <label for="" class="cus-form-label">Last Name of Deceased <span
                                    class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="Last_Name_of_Deceased:" class="last_name" id="" type="text" value=""
                                    aria-invalid="false" required>
                            </div>
                        </li>

                        <li class="form-li">
                            <label for="" class="cus-form-label">Suffix of Deceased </label>
                            <div class="input-con">
                                <select name="Suffix_of_Deceased:" id="input_11_109" class="medium gfield_select"
                                    aria-invalid="false" required>
                                    <option value="Select one" selected="selected">Select one</option>
                                    <option value="DDS">DDS</option>
                                    <option value="MD">MD</option>
                                    <option value="PHD">PHD</option>
                                    <option value="JR">JR</option>
                                    <option value="SR">SR</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="VI">VI</option>
                                </select>
                            </div>
                        </li>

                        <li class="form-li">
                            <label for="" class="cus-form-label">Social Security # of Deceased <span
                                    class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="Social_Security_#_of_Deceased:" class="social_security_deceased" id="" type="text"
                                    value="" aria-invalid="false" required>
                            </div>
                        </li>

                        <li class="form-li">
                            <label for="" class="cus-form-label">Confirm Social Security # of Deceased <span
                                    class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="Confirm_Social_Security_#_of_Deceased:" class="confirm_social_security_deceased" id=""
                                    type="text" value="" aria-invalid="false" required>
                                <span class="error_s_security_deceased"> </span>

                                <div class="cus-ssl"><img
                                        src="{{ asset('resources/assets/img/site_images/image_secure.png') }}"
                                        alt="Secure" style="vertical-align:middle;display:inline-block;margin-right:5px;">
                                    Please confirm
                                    your SSN so that it is accurate. We cannot file for EIN number if the SSN is invalid.
                                    Your SSN is secured by latest SSL technology.</div>
                            </div>
                        </li>
                    </ul>
                    <!-- .........................Representative/Executor Information............................... -->
                    <ul class="cus-formcontainer">
                        <li class="cus-form-hd">
                            <h2 class="gsection_title">Representative/Executor Information</h2>
                        </li>
                        <input name="<h2>Representative/Executor_Information</h2>" value="*" style="display: none">
                        <li class="form-li">
                            <label class="cus-form-label" for="">First Name <span class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="First_Name:" class="first_name" id="" type="text" value=""
                                    aria-required="true" aria-invalid="false" required>
                            </div>
                        </li>
                        <li class="form-li">
                            <label for="" class="cus-form-label">Middle Name </label>
                            <div class="input-con">
                                <input name="Middle_Name:" class="middle_name" id="" type="text" value=""
                                    aria-invalid="false">
                            </div>
                        </li>
                        <li class="form-li">
                            <label for="" class="cus-form-label">Last Name <span class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="Last_Name:" class="last_name" id="" type="text" value=""
                                    aria-invalid="false" required>
                            </div>
                        </li>
                        <li class="form-li">
                            <label for="" class="cus-form-label">Suffix</label>
                            <div class="input-con">
                                <select name="Suffix:" id="input_11_17" class="medium gfield_select" aria-invalid="false">
                                    <option value="" selected="selected" class="gf_placeholder">Select one</option>
                                    <option value="DDS">DDS</option>
                                    <option value="MD">MD</option>
                                    <option value="PHD">PHD</option>
                                    <option value="JR">JR</option>
                                    <option value="SR">SR</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="VI">VI</option>
                                </select>
                            </div>
                        </li>
                        <li class="form-li">
                            <label for="" class="cus-form-label">Title <span class="req-feild">*</span></label>
                            <div class="input-con">
                                <select name="Title:" id="input_11_18" class="medium gfield_select" aria-required="true"
                                    aria-invalid="false" required>
                                    <option value="" selected="selected" class="gf_placeholder">Select one</option>
                                    <option value="Executor">Executor</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Personal Representative">Personal Representative</option>
                                </select>
                            </div>
                        </li>
                        <li class="form-li">
                            <label for="" class="cus-form-label">Social Security # <span
                                    class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="Social_Security_#:" class="social_security" id="" type="text" value=""
                                    aria-invalid="false" required>
                            </div>
                        </li>
                        <li class="form-li">
                            <label for="" class="cus-form-label">Confirm Social Security # <span
                                    class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="Confirm_Social_Security_#:" class="confirm_social_security" id="" type="text"
                                    value="" aria-invalid="false" required>
                                <span class="error_s_security"> </span>

                                <div class="cus-ssl"><img
                                        src="{{ asset('resources/assets/img/site_images/image_secure.png') }}"
                                        alt="Secure" style="vertical-align:middle;display:inline-block;margin-right:5px;">
                                    Please confirm
                                    your SSN so that it is accurate. We cannot file for EIN number if the SSN is invalid.
                                    Your SSN is secured by latest SSL technology.</div>
                            </div>
                        </li>


                    </ul>
                    <!-- .........................Executor or Legal Personal Representative Address (No PO Boxes)............................... -->
                    <ul class="cus-formcontainer">
                        <li class="cus-form-hd">
                            <h2 class="gsection_title">Executor or Legal Personal Representative Address (No PO Boxes)</h2>
                        </li>
                        <input name="<h2>Executor_or_Legal_Personal_Representative_Address_(No_PO Boxes)</h2>" value="*"
                            style="display: none">
                        <li class="form-li">
                            <label class="cus-form-label" for="">Address <span class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="Address:" id="" type="text" value="" aria-required="true" aria-invalid="false"
                                    required>
                                <span>Address</span>
                                <input name="Address_2:" id="" type="text" value="" aria-required="true"
                                    aria-invalid="false" placeholder="Apt, Suite or Unit (Optional)">
                                <span>Address 2</span>
                                <input class="small-input city" name="City:" id="" type="text" value="" aria-required="true"
                                    aria-invalid="false">
                                <span>city</span>
                                <input class="small-input state" name="State:" id="" type="text" value=""
                                    aria-required="true" aria-invalid="false">
                                <span>state</span>
                                <input class="small-input zipcode" name="Zipcode:" id="" type="text" value=""
                                    aria-required="true" aria-invalid="false">
                                <span>zipcode</span>
                            </div>
                        </li>
                        <li class="form-li">
                            <label for="" class="cus-form-label">Country <span class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="" id="" class="country" type="text" value="" aria-invalid="false"
                                    required>
                            </div>
                        </li>
                        <li class="form-li">
                            <label for="" class="cus-form-label">Do you want to receive your mail at another address? <span
                                    class="req-feild">*</span></label>
                            <div class="">
                                <input name="Q) Do you want to receive your mail at another address? " type="radio"
                                    value="A) No" checked="checked" id="label_7_29_0" required>
                                <label for="" id="label_7_29_0">No</label>
                                <input name="Q) Do you want to receive your mail at another address? " type="radio"
                                    value="A) Yes" id="label_7_29_0" required>
                                <label for="" id="label_7_29_0">Yes</label>
                            </div>
                        </li>
                    </ul>
                    <!-- ........................................................ -->
                    <!-- .........................Estate Information............................... -->

                    <ul class="cus-formcontainer">
                        <li class="cus-form-hd">
                            <h2 class="gsection_title">Estate Information</h2>
                        </li>
                        <input name="<h2>Estate_Information</h2>" value="*" style="display: none">
                        <li class="form-li">
                            <label class="cus-form-label" for="">Date of Death <span
                                    class="req-feild">*</span></label>
                            <div class="input-con">
                                <select name="Date_of_Death:" aria-required="true" required>
                                    <option value="">Month</option>
                                    <option value="Month: 1">1</option>
                                    <option value="Month: 2">2</option>
                                    <option value="Month: 3">3</option>
                                    <option value="Month: 4">4</option>
                                    <option value="Month: 5">5</option>
                                    <option value="Month: 6">6</option>
                                    <option value="Month: 7">7</option>
                                    <option value="Month: 8">8</option>
                                    <option value="Month: 9">9</option>
                                    <option value="Month: 10">10</option>
                                    <option value="Month: 11">11</option>
                                    <option value="Month: 12">12</option>
                                </select>
                                <select name="Day:" id="" aria-required="true" required>
                                    <option value="">Day</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                                <select name="Year:" id="input_7_36_3" aria-required="true" required>
                                    <option value="">Year</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                    <option value="2009">2009</option>
                                    <option value="2008">2008</option>
                                    <option value="2007">2007</option>
                                    <option value="2006">2006</option>
                                    <option value="2005">2005</option>
                                    <option value="2004">2004</option>
                                    <option value="2003">2003</option>
                                    <option value="2002">2002</option>
                                    <option value="2001">2001</option>
                                    <option value="2000">2000</option>
                                    <option value="1999">1999</option>
                                    <option value="1998">1998</option>
                                    <option value="1997">1997</option>
                                    <option value="1996">1996</option>
                                    <option value="1995">1995</option>
                                    <option value="1994">1994</option>
                                    <option value="1993">1993</option>
                                    <option value="1992">1992</option>
                                    <option value="1991">1991</option>
                                    <option value="1990">1990</option>
                                    <option value="1989">1989</option>
                                    <option value="1988">1988</option>
                                    <option value="1987">1987</option>
                                    <option value="1986">1986</option>
                                    <option value="1985">1985</option>
                                    <option value="1984">1984</option>
                                    <option value="1983">1983</option>
                                    <option value="1982">1982</option>
                                    <option value="1981">1981</option>
                                    <option value="1980">1980</option>
                                    <option value="1979">1979</option>
                                    <option value="1978">1978</option>
                                    <option value="1977">1977</option>
                                    <option value="1976">1976</option>
                                    <option value="1975">1975</option>
                                    <option value="1974">1974</option>
                                    <option value="1973">1973</option>
                                    <option value="1972">1972</option>
                                    <option value="1971">1971</option>
                                    <option value="1970">1970</option>
                                    <option value="1969">1969</option>
                                    <option value="1968">1968</option>
                                    <option value="1967">1967</option>
                                    <option value="1966">1966</option>
                                    <option value="1965">1965</option>
                                    <option value="1964">1964</option>
                                    <option value="1963">1963</option>
                                    <option value="1962">1962</option>
                                    <option value="1961">1961</option>
                                    <option value="1960">1960</option>
                                    <option value="1959">1959</option>
                                    <option value="1958">1958</option>
                                    <option value="1957">1957</option>
                                    <option value="1956">1956</option>
                                    <option value="1955">1955</option>
                                    <option value="1954">1954</option>
                                    <option value="1953">1953</option>
                                    <option value="1952">1952</option>
                                    <option value="1951">1951</option>
                                    <option value="1950">1950</option>
                                    <option value="1949">1949</option>
                                    <option value="1948">1948</option>
                                    <option value="1947">1947</option>
                                    <option value="1946">1946</option>
                                    <option value="1945">1945</option>
                                    <option value="1944">1944</option>
                                    <option value="1943">1943</option>
                                    <option value="1942">1942</option>
                                    <option value="1941">1941</option>
                                    <option value="1940">1940</option>
                                    <option value="1939">1939</option>
                                    <option value="1938">1938</option>
                                    <option value="1937">1937</option>
                                    <option value="1936">1936</option>
                                    <option value="1935">1935</option>
                                    <option value="1934">1934</option>
                                    <option value="1933">1933</option>
                                    <option value="1932">1932</option>
                                    <option value="1931">1931</option>
                                    <option value="1930">1930</option>
                                    <option value="1929">1929</option>
                                    <option value="1928">1928</option>
                                    <option value="1927">1927</option>
                                    <option value="1926">1926</option>
                                    <option value="1925">1925</option>
                                    <option value="1924">1924</option>
                                    <option value="1923">1923</option>
                                    <option value="1922">1922</option>
                                    <option value="1921">1921</option>
                                    <option value="1920">1920</option>
                                </select>
                            </div>
                        </li>

                        <li class="form-li">
                            <label for="" class="cus-form-label">Closing month of accounting year <span
                                    class="req-feild">*</span></label>
                            <div class="input-con">
                                <select name="Closing_month_of_accounting_year:" id="input_11_104"
                                    class="medium gfield_select" aria-required="true" aria-invalid="false">
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December" selected="selected">December</option>
                                </select>
                            </div>
                        </li>

                        <li class="form-li">
                            <label for="" class="cus-form-label">Do you have, or do you expect to have, any employees who
                                will receive Forms W-2 in the next 12 months? <span class="req-feild">*</span></label>
                            <div class="full-radio">
                                <div>
                                    <input
                                        name="Q)_Do_you_have,_or_do_you_expect_to_have,_any_employees_who_will_receive_Forms_W-2_in_the_next_12_months?"
                                        type="radio" value="A) No" checked="checked" id="label_7_29_0">
                                    <label for="label_7_29_0" id="label_7_29_0">No</label>
                                </div>
                                <div>
                                    <input
                                        name="Q)_Do_you_have,_or_do_you_expect_to_have,_any_employees_who_will_receive_Forms_W-2_in_the_next_12_months?"
                                        type="radio" value="A) Yes" id="label_7_29_1">
                                    <label for="label_7_29_1" id="label_7_29_1">Yes</label>
                                </div>
                            </div>
                        </li>

                    </ul>

                    <!-- .................................................. -->
                    <!-- .........................contact info............................... -->
                    <ul class="cus-formcontainer">
                        <li class="cus-form-hd">
                            <h2 class="gsection_title">Contact Information</h2>
                            <p>We will contact you if we need any additional information to obtain an EIN number for you.
                            </p>
                        </li>
                        <input name="<h2>Contact_Information</h2>" value="*" style="display: none">

                        <li class="form-li">
                            <label class="cus-form-label" for="">Recipient Email <span
                                    class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="Recipient_Email:" class="email" id="" type="email" value=""
                                    aria-required="true" aria-invalid="false" required>
                                <span>Enter Email</span>
                                <input name="Confirm_Email:" required class="confirm_email" id="" type="email" value=""
                                    aria-required="true" aria-invalid="false" placeholder=""> 
                                <span class="error_email" >Confirm Email</span>
                            </div>
                        </li>
                        <li class="form-li">
                            <label for="" class="cus-form-label">Recipient Phone Number <span
                                    class="req-feild">*</span></label>
                            <div class="input-con">
                                <input name="Recipient_Phone_Number:" class="recipient_phone_number" id="" type="text"
                                    value="" aria-invalid="false" required>
                            </div>
                        </li>

                        <li class="form-li">
                            <label for="" class="cus-form-label">Agreement <span class="req-feild">*</span></label>
                            <div class="input-con cus-check">
                                <p>
                                    <input name="Agreement" id="input_7_54_1" type="checkbox" aria-required="true"
                                        aria-invalid="false" required> <span>By checking this box, I am
                                        electronically signing to authorize EIN Tax Id Filing and its agents as my third
                                        party designee and allow them to apply and receive the EIN number on my behalf. I
                                        agree to receive sms, email and calls about my order and to the privacy policy and
                                        terms and conditions listed on this website. I also affirm the information listed
                                        above is accurate and truthful.</span>
                                </p>
                            </div>
                        </li>


                    </ul>

                    <ul class="cus-formcontainer boder-top">
                        <li class="form-li">
                            <label for="" class="cus-form-label"></label>
                            <div>
                                <input type="submit" value="Submit Appliacation" class="sub-btn">
                            </div>
                        </li>
                    </ul>
                </form>
                <!-- ........................................................ -->
            </div>
        </div>
    </section>
@endsection
