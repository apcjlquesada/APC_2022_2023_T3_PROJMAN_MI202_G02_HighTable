<?php 
session_start();

if(isset($_SESSION['auth'])){
    $_SESSION['message'] = "You are already logged in";
    header('Location: index.php');
    exit();
}

include('includes/header.php'); 


?>


<div class="registerContainer py-5">
    <div class="container">
        <div class=" row justify-content-center">
            <div class="col-md-12">
                <?php if(isset($_SESSION['message'])) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message']; ?>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_SESSION['message']);
                } ?>
                    <div class="registrationForm card">
                        <div class="registrationHeader card-header">
                            <h4>Registration Form</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                        <form action="functions/authcode.php" method="POST">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">First Name</label>
                                                <input type="text" required name="first_name" class="form-control mb-2">
                                            </div>    
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">Last Name</label>
                                                <input type="text" required name="last_name" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label mb-0">Contact Number</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <div class="input-group-text">+63</div>
                                                    </div>
                                                    <input type="tel" required name="phone" class="form-control mb-2" pattern="[0-9]{3}[0-9]{3}[0-9]{4}">
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="display:none;">
                                                <label class="form-label mb-0">Address Name</label>
                                                <input type="hidden" required name="address_name" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                    <?php
                                                    require_once 'config/dbcon.php';
                                                        $region = '';
                                                        $query = "SELECT region FROM address GROUP BY region ORDER BY region ASC";
                                                        $result = mysqli_query($con, $query);
                                                        while($rows = mysqli_fetch_array($result)){
                                                            $region .= '<option value="'.$rows["region"].'">'.$rows["region"].'</option>';
                                                        }
                                                    ?>
                                                <label class="form-label mb-0">Region</label>
                                                <select name="region" id="region" class="form-control mt-2 action"> 
                                                    <option value="" selected disabled>Select Region</option>
                                                    <?php echo $region; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">Province</label>
                                                <select name="province" id="province" class="form-control mt-2 action">
                                                    <option value="">Select Province</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">City</label>
                                                <select name="city" id="city" class="form-control mb-2 action">
                                                    <option value="">Select City</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">Barangay</label>
                                                <select name="barangay" id="barangay" class="form-control mb-2 action">
                                                    <option value="">Select Barangay</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-6" style="display:none;">
                                                <label class="form-label mb-0">Delivery Fee</label>
                                                <select name="delivery_fee" id="delivery_fee" class="form-control ">
                                                    <option value="">Select Fee</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">House Number</label>
                                                <input type="text" required name="house_number" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">Street Name</label>
                                                <input type="text" required name="street" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">Nearest Landmark</label>
                                                <input type="text" required name="landmark" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">Zip Code</label>
                                                <input type="text" required name="postal_code" class="form-control mb-2" maxlength="4" pattern="[0-9]{4}">
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                            <div class="col-md-12">
                                                    <label for="exampleInputEmail1" class="form-label mb-0">Email address</label>
                                                    <input type="email" required name="email" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp"> <!--pattern="^[a-zA-Z0-9$&+,:;=?@#|'<>.-^*()%!]+@gmail\.com$" -->
                                            </div>
                                            <div class="col-md-12">
                                                    <label class="col-md-12 control-label" for="passwordinput">
                                                        Password
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input id="password" class="form-control mb-1 input-md password-input"  
                                                        name="password" type="password" 
                                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                        <div id="popover-password">
                                                            <input type="checkbox" onclick="passwordFunction()" class="form-check-input mb-3"> Show Password
        
                                                            <p><span id="result"></span></p>
                                                            <div class="progress">
                                                                <div id="password-strength" 
                                                                    class="progress-bar" 
                                                                    role="progressbar" 
                                                                    aria-valuenow="40" 
                                                                    aria-valuemin="0" 
                                                                    aria-valuemax="100" 
                                                                    style="width:0%">
                                                                </div>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li class="">
                                                                    <span class="low-upper-case">
                                                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                                                        &nbsp;Lowercase &amp; Uppercase
                                                                    </span>
                                                                </li>
                                                                <li class="">
                                                                    <span class="one-number">
                                                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                                                        &nbsp;Number (0-9)
                                                                    </span> 
                                                                </li>
                                                                <li class="">
                                                                    <span class="eight-character">
                                                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                                                        &nbsp;At least 8 Character
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-12">
                                                    <label class="form-label mb-0">Confirm Password</label>
                                                    <input type="password" required name="confirm_password" class="form-control mb-2" id="paste-no-event">
                                            </div>
                                            Kindly read and agree with our <span><button type="button" class="btn btn-primary termsCondition" data-bs-toggle="modal" data-bs-target="#terms">Terms and Conditions</button></span> and <span><button type="button" class="btn btn-primary termsCondition" data-bs-toggle="modal" data-bs-target="#data-privacy">Privacy Policy</button></span> before registering.
                                            <small class="text-danger alert"></small>
                                            <br><button type="submit" name="register_btn" class="btn btn-primary mb-2 mt-2 col-md-3 btn-green" id="registerbtn" disabled="true">Register</button>
                                            <div class="accountReady">
                                                <h7>Already have an account? <span class="registerSpan"><a href="login.php">Login here</a></span></h3>
                                            </div>

                                            <!-- Scrollable modal for Terms and Condition-->
                                            <div class="modal fade" id="terms" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-3">
                                                <h5>General</h5>
                                                <p> By accessing and placing an order with Chubby Gourmet, you confirm that you agree with and bound by the terms of service contained in the Terms & Conditions outlined below. These terms apply to the entire web application and any email or other type of communication between you and Chubby Gourmet.
                                                </p>
                                                <p>
                                                Under no circumstances shall Chubby Gourmet team be liable for any direct, indirect, special, incidental, or consequential damages, including, but not limited to, loss of data or profit, arising out of the use, or the inability to use, the materials on this site, even if Chubby Gourmet team or an authorized representative has been advised of the possibility of such damages. If your use of materials from this site results in the need for servicing, repair or correction of equipment or data, you assume any costs thereof.
                                                </p>
                                                <p>
                                                Chubby Gourmet will not be responsible for any outcome that may occur during the course of usage of our resources. We reserve the rights to change prices and revise the resources usage policy in any moment.
                                                </p>
                                                <h5>License</h5>
                                                <p>
                                                Chubby Gourmet grants you a revocable, non-exclusive, non- transferable, limited license to use the website strictly in accordance with the terms of this Agreement. These Terms & Conditions are a contract between you and Chubby Gourmet ("we," "our," or "us") grants you a revocable, non-exclusive, non- transferable, limited license to download, install and use the website strictly in accordance with the terms of this Agreement.
                                                </p>
                                                <h5>Definitions and Key terms </h5>

                                                <strong>Cookie:</strong>  small amount of data generated by a website and saved by your browser, provide analytics, remember information about you such as your language preference or login information.
                                                <br>
                                                <strong>Company:</strong> when this policy mentions “Company,” “we,” “us,” or “our,” it refers to Chubby Gourmet, Laguna Bel Air 1, Sta. Rosa, Laguna that is responsible for your information under this Privacy Policy.
                                                <br>
                                                <strong>Customer:</strong> refers to the company, organization or person that signs up to use the Chubby Gourmet Service to manage the relationships with your consumers or service users.
                                                <br>
                                                <strong>Device:</strong> any internet connected device such as a phone, tablet, computer, or any other device that can be used to visit Chubby Gourmet and use its services.
                                                <br>
                                                <strong>IP address:</strong> Every device connected to the Internet is assigned a number known as an Internet protocol (IP) address. These numbers are usually assigned in geographic blocks. An IP address can often be used to identify the location from which device is connecting to the Internet.
                                                <br>
                                                <strong>Personal Data:</strong> any information that directly, indirectly, or in connection with other information — including a personal identification number — allows for the identification or identifiability of a natural person.
                                                <br>
                                                <strong>Service:</strong> refers to the service provided by Chubby Gourmet as described in the relative terms (if available) and on this platform.
                                                <br>
                                                <strong>Third-party service:</strong> refers to advertisers, contest sponsors, promotional and marketing partners, and others who provide our content or whose products or services we believe may interest you.
                                                <br>
                                                <strong>Website:</strong> Chubby Gourmet's site, which can be accessed via this URL: null.
                                                <br>
                                                <strong>You:</strong> a person or entity that is registered with Chubby Gourmet to use the Services.
                                                <br>
                                                <br>
                                                <h5>Restrictions</h5>
                                                <p>
                                                You agree not to, and you will not permit others to:
                                                </p>
                                                <p>
                                                License, sell, rent, lease, assign, distribute, transmit, host, outsource, disclose, or otherwise commercially exploit the service or make the platform available to any third party.
                                                </p>
                                                <p>
                                                Modify, make derivative works of, disassemble, decrypt, reverse compile, or reverse engineer any part of the service.
                                                </p>
                                                <p>
                                                Remove, alter or obscure any proprietary notice (including any notice of copyright or trademark) of or its affiliates, partners, suppliers or the licensors of the service.
                                                </p>
                                                <br>
                                                <h5>Payment</h5>
                                                After placing down your order, you agree to pay all fees or charges to your account for the Service in accordance with the fees, charges and billing terms in effect at the time that each fee or charge is due and payable. The Payment Provider you have chosen is also in agreement that governs your use of the designated credit card account/e-wallet and you must refer to that agreement and not these Terms to determine your rights and liabilities with respect to your chosen Payment Provider. By providing us with your payment information, you agree that we are authorized to verify information immediately, and subsequently invoice your account for all fees and charges due and payable to us hereunder and that no additional notice or consent is required. You agree to immediately notify us of any change in your billing address or the credit card/e-wallet used for payment hereunder. We reserve the right at any time to change its prices and billing methods, either immediately upon posting on our Site or by e-mail delivery to you yourself. Any attorney fees, court costs, or other costs incurred in collection of delinquent undisputed amounts shall be the responsibility of and paid for by you. No contract will exist between you and us for the Service until we accept your order by a confirmatory e-mail, SMS/MMS message, or other appropriate means of communication. You are responsible for any third-party fees that you may incur when using the Service.
                                                <br>
                                                <br>
                                                <h5>Return and Refund Policy</h5>
                                                <p>Thanks for shopping with us. We appreciate the fact that you took part in purchasing our home cooked foods. We also want to make sure you have a rewarding experience while you're exploring, evaluating, and purchasing our products. As with any shopping experience, there are terms and conditions that apply to transactions at our company. We'll be as brief as our attorneys will allow. The main thing to remember is that by placing an order or making a purchase from us, you agree to the terms along with our Privacy Policy.
                                                </p><p>
                                                If, for any reason, you are not completely satisfied with any good or service that we provide, do not hesitate to contact us and we will discuss any of the issues you are going through with our product and agree to conduct a refund policy if any of the following scenarios occur:
                                                <ul>
                                                    <li>Product never arrived.</li>
                                                    <li>Wrong Product has arrived.</li>
                                                    <li>Order is not complete and certain product will be refunded.</li>
                                                </ul>
                                                </p>

                                                <h5>Your Suggestions</h5>
                                                <p>
                                                Any feedback, comments, ideas, improvements, or suggestions (collectively, "Suggestions") provided by you to us with respect to the service shall remain the sole and exclusive property of us. We shall be free to use, copy, modify, publish, or redistribute the Suggestions for any purpose and in any way without any credit or any compensation to you.
                                                </p>
                                                <h5>Your Consent</h5>
                                                <p>
                                                We`ve updated our Terms & Conditions to provide you with complete transparency into what is being set when you visit our site and how it’s being used. By using our service, registering an account, or making a purchase, you hereby consent to our Terms & Conditions and the Privacy Act Policy.
                                                </p>
                                                <h5>Links to Other Websites</h5>
                                                <p>
                                                Our service may contain links to other websites that are not operate by Us. If you click on a third link, you will be directed to that third party’s site. We strongly advise you to review the Terms & Conditions of every you visit.
                                                </p>
                                                <h5>Changes to Your Terms & Conditions</h5>
                                                <p>
                                                You acknowledge and agree that we may stop (permanently or temporarily) providing the Service (or any features within the Service)
                                                to you or to users generally at our sole discretion, without prior notice to you. You may stop using the Service at any time. You do not need to specifically inform us when you stop using the Service. You acknowledge and agree that if we disable access to your account, you may be prevented from accessing the Service, your account details or any files or other materials which is contained in your account. If we decide to change our Terms & Conditions, we will post those changes on this page, and/or update the Terms & Conditions modification date below.
                                                </p>
                                                <h5>Modification to Our service</h5>
                                                <p>
                                                We reserve the right to modify, suspend or discontinue, temporarily or permanently, the service to which it connects, with or without notice and without liability to you.
                                                </p>
                                                <h5>Updates to Our Service</h5>
                                                <p>
                                                We may from time to time provide enhancements or improvements to the features/ functionality of the service, which may include patches, bug fixes, updates, upgrades, and other modifications ("Updates"). Updates may modify or delete certain features and/or functionalities of the service. You agree that we have no obligation to (i) provide any Updates, or (ii) continue to provide or enable any particular features and/or functionalities of the service to you. You further agree that all Updates will be (i) deemed to constitute an integral part of the service, and (ii) subject to the terms and conditions of this Agreement.
                                                </p>
                                                <h5>Third-Party Services</h5>
                                                <p>
                                                We may display, include, or make available third-party content (including data, information, applications and other products services) or provide links to third-party websites or services such as the payment modal ("Third- Party Services"). You acknowledge and agree that we shall not be responsible for any Third-Party Services, including their accuracy, completeness, timeliness, validity, copyright compliance, legality, decency, quality, or any other aspect thereof. We do not assume and shall not have any liability or responsibility to you or any other person or entity for any Third-Party Services. Third-Party Services and links thereto are provided solely as a convenience to you, and you access and use them entirely at your own risk and subject to such third parties’ terms and conditions.
                                                </p>
                                                <h5>Term and Termination</h5>
                                                <p>
                                                This Agreement shall remain in effect until terminated by you or us. We may, in its sole discretion, at any time and for any or no reason, suspend or terminate this Agreement with or without prior notice. This Agreement will terminate immediately, without prior notice from us, in the event that you fail to comply with any provision of this Agreement. Termination of this Agreement will not limit any of our rights or remedies at law or in equity in case of breach by you (during the term of this Agreement) of any of your obligations under the present Agreement.
                                                </p>



                                                <h5>Copyright Infringement Notice</h5>
                                                <p>
                                                If you are a copyright owner or such owner's agent and believe any material from us constitutes an infringement on your copyright, please contact us setting forth the following information: (a) a physical or electronic signature of the copyright owner or a person authorized to act on his behalf; (b) identification of the material that is claimed to be infringing; (c) your contact information, including your address, telephone number, and an email; (d) a statement by you that you have a good faith belief that use of the material is not authorized by the copyright owners; and (e) the a statement that the information in the notification is accurate, and, under penalty of perjury you are authorized to act on behalf of the owner.
                                                </p>
                                                <h5>Indemnification</h5>
                                                <p>
                                                You agree to indemnify and hold us and our parents, subsidiaries, affiliates, employees, agents, partners, and licensors, (if any) harmless from any claim or demand, including reasonable attorney’s fees due to arising out of your: (a) use of your service; (b) violation of this Agreement or any law or regulation; or (c) violation of any right of a third party.
                                                </p>
                                                <h5>No Warranties</h5>
                                                <p>
                                                The service is provided to you "AS IS" and "AS AVAILABLE" and with all faults and defects without warranty of any kind (due to the kind of product we provide which is food). Without limiting the foregoing, neither us nor any provider makes any representation or warranty of any kind, express or implied: (i) as to the operation or availability of the service, or the information, content, and materials or products included thereon; (ii) that the service will be uninterrupted or error-free; (iii) as to the accuracy, reliability, or currency of any information or content provided through the service; or (iv) that the service, its servers, the content, or e-mails sent from or on behalf of us are free of viruses, scripts, trojan horses, worms, malware, timebombs or other harmful components. Some jurisdictions do not allow the exclusion of or limitations on implied warranties or the limitations on the applicable statutory rights of a consumer, so some or all of the above exclusions and limitations may not apply to you.
                                                </p>







                                                <h5>Limitation of Liability</h5>
                                                <p>
                                                Notwithstanding any damages that you might incur, the entire liability of us and any of our suppliers under any provision of this Agreement and your exclusive remedy for all of the foregoing shall be limited to the amount actually paid by you for the service. To the maximum extent permitted by applicable law, in no event shall we or our suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever (including, but not limited to, damages for loss of profits, for loss of data or other information, for business interruption, for personal injury, for loss of privacy arising out of or in any way related to the use of or inability to use the service, third-party software and/or third-party hardware used with the service, or otherwise in connection with any provision of this Agreement), even if we or any supplier has been advised of the possibility of such damages and even if the remedy fails of its essential purpose.
                                                </p>
                                                
                                                <h5>Severability</h5>
                                                <p>
                                                If any provision of this Agreement is held to be unenforceable or invalid, such provision will be changed and interpreted to accomplish the objectives of such provision to the greatest extent possible under applicable law and the remaining provisions will continue in full force and effect.
                                                </p>
                                                <p>
                                                This Agreement, together with the Privacy Policy and any other legal notices published by us on the Services, shall constitute the entire agreement between you and us concerning the Services. If any provision of this Agreement is deemed invalid by a court of competent jurisdiction, the invalidity of such provision shall not affect the validity of the remaining provisions of this Agreement, which shall remain in full force and effect. No waiver of any term of this Agreement shall be deemed a further or continuing waiver of such term or any other term, and our failure to assert any right or provision under this Agreement shall not constitute a waiver of such right or provision. YOU AND US AGREE THAT ANY CAUSE OF ACTION ARISING OUT OF OR RELATED TO THE SERVICES MUST COMMENCE WITHIN ONE (1) YEAR AFTER THE CAUSE OF ACTION ACCRUES. OTHERWISE, SUCH CAUSE OF ACTION IS PERMANENTLY BARRED.
                                                </p>




                                                <h5>Waiver</h5>
                                                <p>
                                                Except as provided herein, the failure to exercise a right or to require performance of an obligation under this Agreement shall not affect a party's ability to exercise such right or require such performance at any time thereafter nor shall be the waiver of a breach constitute waiver of any subsequent breach.
                                                No failure to exercise, and no delay in exercising, on the part of either party, any right or any power under this Agreement shall operate as a waiver of that right or power. Nor shall any single or partial exercise of any right or power under this Agreement preclude further exercise of that or any other right granted herein. In the event of a conflict between this Agreement and any applicable purchase or other terms, the terms of this Agreement shall govern.
                                                </p>
                                                <h5>Amendments to this Agreement</h5>
                                                <p>
                                                
                                                We reserve the right, at its sole discretion, to modify or replace this Agreement at any time. If a revision is material, we will provide at least 30 days’ notice prior to any new terms taking effect. What constitutes a material change will be determined by at our sole discretion. By continuing to access or use our service after any revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, you are no longer authorized to use our service.
                                                </p>
                                                <h5>Entire Agreement</h5>
                                                <p>
                                                The agreement constitutes the entire agreement between you and us regarding your use of the service and supersedes all prior and contemporaneous written or oral agreements between you and us. You may be subject to additional terms and conditions that apply when you use or purchase other services from us, which we will provide to you at the time of such use or purchase.
                                                </p>
                                                <h5>Updates to Our Terms</h5>
                                                <p>
                                                We may change our Service and policies, and we may need to make changes to these Terms so that they accurately reflect our Service and policies. Unless otherwise required by law, we will notify you (for example, through our Service) before we make changes to these Terms and give you an opportunity to review them before they go into effect. Then, if you continue to use the Service, you will be bound by the updated Terms. If you do not want to agree to these or any updated Terms, you may not proceed into continuing to use our service.
                                                </p>


                                                <h5>Intellectual Property</h5>
                                                <p>
                                                Our platform and its entire contents, features and functionality (including but not limited to all information, software, text, displays, images, video and audio, and the design, selection, and arrangement thereof), are owned by us, its licensors or other providers of such material and are protected by Philippines and international copyright, trademark, patent, trade secret and other intellectual property or proprietary rights laws. The material may not be copied, modified, reproduced, downloaded, or distributed in any way, in whole or in part, without the express prior written permission of us, unless and except as is expressly provided in these Terms & Conditions. Any unauthorized use of the material is prohibited.
                                                </p>
                                                <h5>Agreement to Arbitrate</h5>
                                                <p>
                                                This section applies to any dispute EXCEPT IT DOESN'T INCLUDE A DISPUTE RELATING TO CLAIMS FOR INJUNCTIVE OR EQUITABLE RELIEF REGARDING THE ENFORCEMENT OR VALIDITY OF YOUR OR’s INTELLECTUAL PROPERTY RIGHTS. The term “dispute” means any dispute, action, or other controversy between you and us concerning the Services or this agreement, whether in contract, warranty, tort, statute, regulation, ordinance, or any other legal or equitable basis. “Dispute” will be given the broadest possible meaning allowable under law.
                                                </p>
                                                <h5>Notice of Dispute</h5>
                                                <p>
                                                In the event of a dispute, you or us must give the other a Notice of Dispute, which is a written statement that sets forth the name, address, and contact information of the party giving it, the facts giving rise to the dispute, and the relief requested. You must send any Notice of Dispute via email to:. We will send any Notice of Dispute to you by mail to your address if we have it, or otherwise to your email address. You and us will attempt to resolve any dispute through informal negotiation within sixty (60) days from the date the Notice of Dispute is sent. After sixty (60) days, you or us may commence arbitration.
                                                </p>
                                                <h5>Binding Arbitration</h5>
                                                <p>
                                                If you and us don`t resolve any dispute by informal negotiation, any other effort to resolve the dispute will be conducted exclusively by binding arbitration as described in this section. You are giving up the right to litigate (or participate in as a party or class member) all disputes in court before a judge or jury. The dispute shall be settled by binding arbitration in accordance with the Alternative Dispute Resolution Act of 2004 and the Model Law. Either party may seek any interim or preliminary injunctive relief from any court of competent jurisdiction, as necessary to protect the party’s rights or property pending the completion of arbitration. Any and all legal, accounting, and other costs, fees, and expenses incurred by the prevailing party shall be borne by the non-prevailing party. 
                                                </p>
                                                <h5>Submissions and Privacy</h5>
                                                <p>
                                                In the event that you submit or post any ideas, creative suggestions, designs, photographs, information, advertisements, data, or proposals, including ideas for new or improved products, services, features, technologies, or promotions, you expressly agree that such submissions will automatically be treated as non- confidential and non-proprietary and will become the sole property of us without any compensation or credit to you whatsoever. We and our affiliates shall have no obligations with respect to such submissions or posts and may use the ideas contained in such submissions or posts for any purposes in any medium in perpetuity, including, but not limited to, developing, manufacturing, and marketing products and services using such ideas.
                                                </p>
                                                <h5>Promotions</h5>
                                                <p>
                                                We may, from time to time, include contests, promotions, sweepstakes, or other activities (“Promotions”) that require you to submit material or information concerning yourself. Please note that all Promotions may be governed by separate rules that may contain certain eligibility requirements, such as restrictions as to age and geographic location. You are responsible to read all Promotions rules to determine whether or not you are eligible to participate. If you enter any Promotion, you agree to abide by and to comply with all Promotions Rules. Additional terms and conditions may apply to purchases of goods or services on or through the Services, which terms and conditions are made a part of this Agreement by this reference.
                                                </p>
                                                <h5>Typographical Errors</h5>
                                                <p>
                                                In the event a product is listed at an incorrect price or with incorrect information due to typographical error, we shall have the right to refuse or cancel any orders placed for the product listed at the incorrect price. We shall have the right to refuse or cancel any such order whether or not the order has been confirmed and your credit card charged. If your credit card has already been charged for the purchase and your order is canceled, we shall immediately issue a credit to your credit card account/e-wallet in the amount of the charge.
                                                </p>







                                                <h5>Miscellaneous</h5>
                                                <p>
                                               
                                                If for any reason a court of competent jurisdiction finds any provision or portion of these Terms & Conditions to be unenforceable, the remainder of these Terms & Conditions will continue in full force and effect. Any waiver of any provision of these Terms & Conditions will be effective only if in writing and signed by an authorized representative of us. We will be entitled to injunctive or other equitable relief (without the obligations of posting any bond or surety) in the event of any breach or anticipatory breach by you. We operate and control our Service from our establishment here in the Philippines. These Terms & Conditions (which include and incorporate our Privacy Policy) contains the entire understanding, and supersedes all prior understandings, between you and us concerning its subject matter, and cannot be changed or modified by you. The section headings used in this Agreement are for convenience only and will not be given any legal import.
                                                </p>
                                                <h5>Disclaimer</h5>
                                                <p>
                                                We are not responsible for any content, code, or any other imprecision. We do not provide warranties or guarantees. In no event shall we be liable for any special, direct, indirect, consequential, or incidental damages or any damages whatsoever, whether in an action of contract, negligence, or other tort, arising out of or in connection with the use of the Service or the contents of the Service. We reserve the right to make additions, deletions, or modifications to the contents on the Service at any time without prior notice.
                                                </p>
                                                <p>
                                                Our Service and its contents are provided "as is" and "as available" without any warranty or representations of any kind, whether express or implied. We are a distributor and not a publisher of the content supplied by third parties; as such, our exercises no editorial control over such content and makes no warranty or representation as to the accuracy, reliability or currency of any information, content, service, or merchandise provided through or accessible via our Service. Without limiting the foregoing, we specifically disclaim all warranties and representations in any content transmitted on or in connection with our Service or on sites that may appear as links on our Service, or in the products provided as a part of, or otherwise in connection with, our Service, including without limitation any warranties of merchantability, fitness for a particular purpose or non-infringement of third-party rights. No oral advice or written information given by us or any of its affiliates, employees, officers, directors, agents, or the like will create a warranty. Price and availability information is subject to change without notice. Without limiting the foregoing, we do not warrant that our Service will be uninterrupted, uncorrupted, timely, or error-free.
                                                 </p>
                                                <h5>Contact Us</h5>
                                                
                                                Don`t Hesitate to contact us if you have any questions. <br>
                                                Via Email: priscillamariano403@gmail.com <br>
                                                Via Phone Number: (63) 917 234 5688 <br>

                                                    <br>
                                                    <br>
                                                    <center><input class="form-check-input" type="checkbox" name="check" id="agree" onclick="enable()" required/> I agree on the Terms and Conditions.</center>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- Scrollable modal for Data Privacy Act-->
                                            <div class="modal fade data-privacy" id="data-privacy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Privacy Policy</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                    <div class="modal-body p-3">
                                                    <p>
                                                    By accepting this privacy policy, I (as “Data Subject”) grant my
                                                    free, voluntary and unconditional consent to the collection and
                                                    processing of all Personal Data (as defined below), and account or
                                                    transaction information or records (collectively, the "Information")
                                                    relating to me disclosed/transmitted by me in person or by
                                                    my authorized agent/representative/s to the information database
                                                    system of the food business Chubby Gourmet (CG) and/or any
                                                    of its authorized agent/s or representative/s as Information
                                                    controller, by whatever means in accordance with Republic Act (R.A.)
                                                    10173, otherwise known as the “Data Privacy Act of 2012” of the
                                                    Republic of the Philippines, including its Implementing Rules and
                                                    Regulations (IRR) as well as all other guidelines and issuances by the
                                                    National Privacy Commission (NPC).
                                                    </p>
                                                    <p>
                                                    I understand that my “Personal Data” means any information,
                                                    whether recorded in a material form or not, (a) from which the identity
                                                    of an individual is apparent or can be reasonably and directly
                                                    ascertained by the entity holding the information, or when put together
                                                    with other information would directly and certainly identify an individual,
                                                    (b) about an individual’s race, ethnic origin, marital status, age, color,
                                                    gender, health, education and religious and/or political affiliations, (c)
                                                    referring to any proceeding for any offense committed or alleged to
                                                    have been committed by such individual, the disposal of such
                                                    proceedings, or the sentence of any court in such proceedings, and (d)
                                                    issued by government agencies peculiar to an individual which
                                                    includes, but not limited to, social security numbers and licenses.
                                                    I understand, further, that CG shall keep the Personal Data and
                                                    Information and the business and/or transaction/s that I do with
                                                    CG (the “Business”) in strict confidence, and that the collection and
                                                    processing of all Personal Data and/or Information by CG may be
                                                    used for any of the following purposes (collectively, the “Purposes”): 
                                                        </p>
                                                        <br>
                                                    a.)	to provide, operate, process and administer CG accounts and
                                                    services or to process applications for CG accounts, products
                                                    and/or services, including transactions such as
                                                    order payment, and e-mail subscription letters (whether
                                                    offered or issued by CG or otherwise), and to maintain service
                                                    quality.
                                                    <br><br>
                                                    b.)	to undertake activities related to the provision of the CG services including but not limited to transaction authorization, transaction printing, customer service and conduct of surveys, the act of research reports, product profiles, customer profiling, term sheets or other product related materials, administration of future rewards and loyalty programs.
                                                    <br><br>
                                                    c.)	to comply with any obligations, requirements, policies, procedures, measures or arrangements for sharing data and information within CG and any of its affiliates and subsidiaries ,and any other use of data and information in accordance with any CG programs for compliance with tax, sanctions or prevention or detection of money laundering, terrorist financing or other unlawful activities; and, q. any other transactions and/or purposes analogous or relating directly thereto.
                                                    <br>
                                                    <br>
                                                    d.)	for crime and fraud detection, prevention, investigation and prosecution;
                                                    <br>
                                                    <br>
                                                    <p>
                                                    At the same time, I agree that the Information shall be retained by CG for as long as necessary for the fulfillment of any of the aforementioned Purposes, and shall continue to be retained for a period of two (2) years notwithstanding the termination of any of the above Purposes. Further, I understand that, with respect to my submission, collection and processing of the Personal Data of Related Person/s, it is my duty and responsibility: (i) to inform said Related Person/s of the Purpose/s for which is/their Personal Data have been submitted, collected and processed by CG , (ii) to obtain consent from the said Related Person/s for the collection and processing of their Personal Data/Information in accordance with the Data Privacy Act of 2012, and (iii) to inform CG that such consent from said Related Person/s have been obtained. 
                                                    I/we hereby acknowledge that I/we have been provided with the written notification below on my/our rights as a Data Subject (each, a “Right”, collectively, the “Rights”) in accordance with the Data Privacy Act of 2012, to wit:
                                                    <br><br> i.	to be informed whether Information and/or Personal Data is being or has been processed.  <br>
                                                    ii.	to require CG to correct any Information and/or Personal Data relating to the Data Subject which is inaccurate; <br>
                                                    iii.	to object to the processing of the Information and/or Personal Data in case of changes or amendments to the Information and/or Personal Data supplied or declared to the Data Subject; 
                                                    <br>iv.	to access the Information and/or Personal Data; <br>
                                                    v.	to suspend, withdraw or order the blocking, removal or destruction of the Data Subject's Personal Data from CG database system.<br>
                                                    </p>
                                                        <center><input class="form-check-input" type="checkbox" name="check" id="agree2" onclick="enable()" required/> I agree on the Privacy Policy.</center>

                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </form>
                                </div>
                            </div>
                            
                        
                        </div>
                    </div>
            
            </div>
        </div>
    </div>
</div>

    
<?php include('includes/footer.php');  ?>  
