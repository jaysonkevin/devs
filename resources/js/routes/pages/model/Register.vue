<template>
   
    	<!-- Navigation -->
        <nav class="navbar navbar-expand-md navbar-light nav-header-theme fixed-top-nav">
            <div class="container">
                <router-link :to="'/'" ><img :src="'/image/logo.png'" height="150" style="margin-bottom:-80px;"  /></router-link>
               <router-view/>
            </div>
        </nav>

        <div class="container-fluid vh-100" v-if="!preloading">
            <div class="rounded d-flex justify-content-center">
                <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                    <div class="text-center">
                        <h3>Start your modeling career here</h3>
                    </div>
                    <div class="p-1">
                        <Form  class="form" @submit="registerModel"  :validation-schema="schema"  ref="form">
                            <div class="col-md-12 mb-3">
                                <Field name="firstname" type="text" class="flat-input form-control" placeholder="First Name" />
                                <ErrorMessage class="text-danger errormessage " name="firstname" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <Field name="lastname" type="text" class="flat-input form-control" placeholder="Last Name" />
                                <small><ErrorMessage class="text-danger errormessage " name="lastname" /></small>
                            </div>
                            <div class="col-md-12 mb-3">
                                <vSelect :options="countryList" label="country_name" :reduce="countryList => countryList.country_code" v-model="country">
                                    <template #search="{attributes, events}">
                                        <input
                                            class="vs__search"
                                            v-bind="attributes"
                                            v-on="events"
                                        />
                                </template>
                                </vSelect>
                                <small><span role="alert" v-if="countryError" class="text-danger errormessage">select country </span></small>
                            </div>
                            <div class="col-md-12 mb-3">
                                <Field name="email" type="email" class="flat-input form-control" placeholder="Email" />
                                <ErrorMessage class="text-danger errormessage " name="email" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="input-group">
                                    <Field name="password" v-if="hidepass"  autocomplete  type="password" class="flat-input form-control" placeholder="Password (Min 6 Characters)" />
                                    <Field name="password" v-else type="text" class="flat-input form-control" placeholder="Password (Min 6 Characters)" />
                                   
                                    <a href="javascript:void(0);" class=" icon-a button" @click="toggleShow">
                                        <span class="icon is-small is-right">
                                            <i class="fas eye-icon" :class="{ 'fa-eye-slash': hidepass, 'fa-eye': !hidepass }"></i>
                                        </span>
                                    </a>
                                </div>
                                <small><ErrorMessage class="text-danger errormessage " name="password" /></small>
                            </div>
                            <div class="col-md-12 m-3">
                                <label class="form-check-label">
                                <Field name="agree" type="checkbox"  :value="false"/>
                                <small><ErrorMessage class="text-danger errormessage-checkbox " name="agree" /></small>
                                I accept the 
                                <a href="#"  data-bs-toggle="modal" data-bs-target="#terms_modal" >Terms & Conditions</a></label>
                            </div>
                            <div class="d-grid col-12 mx-auto">
                                <button type="submit"  class="btn btn-theme btn-md">Sign Up</button>
                            </div>
                        </Form>
                        <span> Already have an account ?
                            <router-link class="" to="/model/login">Login</router-link>
                            <router-view/>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid vh-100"  v-else>
            <div class=" justify-content-center text-center">
                <i class="fa-solid fa-star fa-beat" style="--fa-animation-duration: 0.5s;" ></i>
                
            </div>
        </div>
        <!-- MODALS -->
        <div class="modal fade" id="terms_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" >Terms And Conditions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="content__MU_Uc">
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">01. Terms of Service</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">Bossjob ("Bossjob.ph", "us", "we", or "our" as the context requires) provides online career services to talents throughout the world via our websites, apps and other platforms (the "Platforms").</p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">Please read the terms of service (the
                        <!-- -->
                        <b>"Terms of Service"</b>) set forth below, as they apply to your access and use of our services, including our various websites, APIs, email notifications, application buttons and widgets (the
                        <!-- -->
                        <b>"Services"</b>), and any information, text, graphics, photos or other materials uploaded, downloaded or appearing on the Services (collectively referred to as the <b>"Content"</b>). Your access to and use of the Services signifies your acceptance of these Terms of Service and agreement to be bound by them and any and all other applicable terms referenced herein absolutely.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">02. Other applicable terms</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>2.1</b> These Terms of Service refer to the additional terms in our Privacy Policy Statement, which also apply to your use of our Services.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>2.2</b> Our Privacy Policy Statement sets out the terms on which we process any personal data we collect from you, or that you provide to us. By using our Services, you consent to such processing and you warrant that all data provided by you is accurate. You understand that through your use of the Services you consent to the collection and use (as set forth in the Privacy Policy) of this information, including the transfer of this information both within and outside of Singapore for storage, processing and use by us. As part of providing you the Services, we may need to provide you with certain communications, such as service announcements and administrative messages. These communications are considered part of the Services and your Bossjob account, which you may not be able to opt-out from receiving.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">03. Information about us</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">The Services are provided and operated by Yolo Technology Pte Ltd. We are a limited liability company registered in Singapore with Unique Entity Number 201628150K and have our registered office at 20 Kallang Ave #02-02 Pico Creative Centre, Singapore 339411.</p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">04. Changes of terms</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">We may amend the Terms of Service from time to time at our sole discretion without notice or liability to you. By continuing to use the Services following such amendments to the Terms of Service, you agree to be bound by such amendments.</p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">05. Change to our Services</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>5.1</b> The Services that we provide are always evolving and the form and nature of the Services that we provide may change from time to time without prior notice to you. In addition, we may stop (permanently or temporarily) providing the Services (or any features within the Services) to you or to users generally and not be able to provide you with prior notice. We also retain the right to create limits on use and storage at our sole discretion at any time and without prior notice to you.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>5.2</b> We make no representations, warranties or guarantees, whether expressed or implied, that our Services or any content on our site is accurate, complete, up-to-date or free from errors or omissions.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">06. Accessing our Services</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>6.1</b> You may only use our Services and Platforms in compliance with applicable laws and for legitimate purposes. In consideration of you agreeing to these Terms of Service, we grant you a limited, non-transferable, non-exclusive right to download, access and use our Services and Platforms for your own personal and/or career related purposes and for no other purpose.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>6.2</b> We do not guarantee that our Services, or any content, will always be available or be uninterrupted. Access to our Services is permitted on a temporary basis. We may suspend, withdraw, discontinue or change all or any part of our Services without notice. We will not be liable to you if for any reason our Services are unavailable at any time or for any period.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>6.3</b> You are responsible for making all arrangements necessary for you to have access to our Services.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>6.4</b> You are also responsible for ensuring that all persons who access our Services through your internet connection are aware of these Terms of Service and other applicable terms and conditions, and that they comply with them.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">07. Your account and password</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>7.1</b> You are responsible for safeguarding the password that you use to access the Services and for any activities or actions under your password. We encourage you to use "strong" passwords (passwords that use a combination of upper and lower case letters, numbers and symbols) with your account. You must treat such information as confidential. You must not disclose it to any third party. Bossjob cannot and will not be liable for any loss or damage arising from your failure to comply with the above.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>7.2</b> We have the right to disable any password, whether chosen by you or allocated by us, at any time, if in our reasonable opinion you have failed to comply with any of the provisions of these Terms of Service.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>7.3</b> If you become aware, or suspect for any reason, that the security of your log-in details has been compromised, you must promptly notify us at
                        <!-- -->
                        <a class="link__2C7vA" href="mailto:support@bossjob.com" target="_blank" rel="noopener noreferrer">support@bossjob.com</a>.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">08. Your access to use the Services</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">Bossjob gives you a personal, worldwide, royalty-free, non-assignable and non-exclusive licence to use the software that is provided to you by us as part of the Services. This access is for the sole purpose of enabling you to use and enjoy the benefit of the Services as provided by Bossjob, in the manner permitted by these Terms of Service.</p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">09. Our Intellectual property rights</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>9.1</b> All intellectual property rights subsisting in respect of the Services belong to Bossjob or have been lawfully licensed to Bossjob for use in connection with the Services. All rights under applicable laws are hereby reserved. You agree not to upload, post, publish, reproduce, transmit or distribute in any way any component of the Platforms or create derivative works with respect thereto, in violation of any applicable law or regulation, as the website is copyrighted under applicable laws.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>9.2</b> You agree that we are free to use, disclose, adopt and modify all and any ideas, concepts, knowhow, proposals, suggestions, comments and other communications and information provided by you to us (the
                        <!-- -->
                        <b>"Feedback"</b>) in connection with the Services and/or your use of the Services without any payment to you. You hereby waive and agree to waive all and any rights and claims for any consideration, fees, royalties, charges and/or other payments in relation to our use, disclosure, adoption and/or modification of any or all of your Feedback.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">10. Your rights</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>10.1</b> You retain your rights to any Content you submit, post or display on or through the Services. By submitting, posting or displaying Content on or through the Services, you grant us a worldwide, non-exclusive, royalty-free licence (with the right to sublicense) to use, copy, reproduce, process, adapt, modify, publish, transmit, display and distribute such Content in any and all media or distribution methods (now known or later developed).
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>10.2</b> You agree that this licence includes the right for us to provide, promote, and improve the Services and to make Content submitted to or through the Services available to other companies, organisations or individuals who partner with Bossjob for the syndication, broadcast, distribution or publication of such Content on other media and services, subject to our terms and conditions for such Content use.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>10.3</b> Such additional uses by Bossjob or other companies, organisations or individuals who partner with Bossjob may be made with no compensation paid to you with respect to the Content that you submit, post, transmit or otherwise make available through the Services.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>10.4</b> We may modify or adapt your Content in order to transmit, display or distribute it over computer networks and in various media and/or make changes to your Content as are necessary to conform and adapt that Content to any requirements or limitations of any networks, devices, services or media.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>10.5</b> You are responsible for your use of the Services, for any Content you provide, and for any consequences thereof, including the use of your Content by other users and our third party partners. You understand that your Content may be syndicated, broadcast, distributed, or published by our partners and if you do not have the right to submit Content for such use, it may subject you to liability. Bossjob will not be responsible or liable for any use of your Content by Bossjob in accordance with these Terms. You represent and warrant that you have all the rights, power and authority necessary to grant the rights granted herein to any Content that you submit.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">11. Limited liability and warranty</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>11.1</b> Your access to and use of our Services is at your sole risk and is provided “as is”, “as available”. The services are for your personal use only and the entities of Bossjob make no representation or warranty of any kind, expressed or implied, including, without limitation, any warranties on merchantability or fitness for any particular purpose or non-infringement.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>11.2</b> The entire liability of the entities of Bossjob entities and your exclusive remedy with respect to the services or otherwise, is re-performance of defective services. in jurisdictions which do not allow the exclusion or limitation of certain types of liability, our liability will be limited to the maximum extent permitted by law. We do not endorse, warrant or guarantee any material, product or service offered through us or our services. We are not and will not be a party to any transaction between you and any third party.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>11.3</b> In no event shall the aggregate liability of the entities of Bossjob exceed one hundred Singapore dollars (SGD 100).
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>11.4</b> The Entities of Bossjob shall not guarantee or assume any responsibility that:
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>(a)</b> the information presented in our Services is accurate, adequate, current or reliable, or may be used for any purpose other than for general reference;
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>(b)</b> the information presented in our Services is free of defect, error, omission, virus or anything which may change, erase, add to or damage your software, data or equipment;
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>(c)</b> messages sent through the internet including in connection with the Services will be free from interception, corruption, error, delay or loss;
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>(d)</b> access to the Services will be available or be uninterrupted;
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>(e)</b> use of the Services will achieve any particular result; or
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>(f)</b> defects in the Services will be corrected.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>11.5</b> Without limiting the generality of the foregoing, in no event will the entities of Bossjob be liable to you or any other person for any direct, indirect, incidental, special, punitive or consequential loss or damages, including any loss of business, profit, goodwill or reputation arising out of any use, or inability to use, the information or the services, even if any of the entities of Bossjob has been advised of the possibility of such loss or damages.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>11.6</b> You will exercise and rely solely on your own skill and judgment in your use and interpretation of the information and use of the Services. You are responsible to ensure that your use of the information and the Services complies with all applicable legal requirements.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>11.7</b> Without prejudice to the foregoing, if your use of the Services does not proceed satisfactorily and/or where applicable you do not receive appropriate responses to such use from us, as set out in these Terms of Service or otherwise, you are advised to contact us at
                        <!-- -->
                        <a class="link__2C7vA" href="mailto:support@bossjob.com" target="_blank" rel="noopener noreferrer">support@bossjob.com</a>. No such lack of response shall be deemed to constitute any acquiescence or waiver.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>11.8</b> The limitation of liability contained in these Terms of Service will apply to the fullest extent permitted by applicable laws.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">12. Content on the services</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>12.1</b> All Content, whether publicly posted or privately transmitted, is the sole responsibility of the person who originated such Content.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>12.2</b> You warrant that any such contribution does comply with those standards, and you will be liable to us and indemnify us for any breach of that warranty and you will be responsible for any loss or damage we suffer as a result of your breach of warranty.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>12.3</b> Any content you upload to our site will be considered non-confidential and non-proprietary, and we have the right to use, copy, distribute and disclose to third parties any such content for any purpose. We also have the right to disclose your identity to any third party who is claiming that any content posted or uploaded by you to our site constitutes a violation of their intellectual property rights, or of their right to privacy. We will not be responsible, or liable to any third party, for the content or accuracy of any content posted by you or any other user of our Services.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>12.4</b> The views expressed by other users on our Platforms do not represent our views or values. We do maintain the right to remove any posting you make on our site if, in our opinion, your post does not comply with our content standards. We do not endorse, support, represent or guarantee the completeness, truthfulness, accuracy, or reliability of any Content or communications posted via the Services or endorse any opinions expressed via the Services. You understand that by using the Services, you may be exposed to Content that might be offensive, harmful, inaccurate or otherwise inappropriate, or in some cases, postings that have been mislabelled or are otherwise deceptive.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>12.5</b> Under no circumstances will we be liable in any way for any Content, including, but not limited to, any errors or omissions in any Content, or any loss or damage of any kind, incurred directly or indirectly as a result of the use of the Services by any third party, including without limitation any defamatory, offensive, or illegal conduct of the third party, or the use of any Content posted, emailed, transmitted, or otherwise made available via the Services or broadcast elsewhere.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>12.6</b> We may not monitor or control the Content posted via the Services and, we cannot take responsibility for such Content. Any use or reliance on any Content or materials posted via the Services or obtained by you through the Services is at your own risk.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">13. Content copyright policy</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>13.1</b> Bossjob respects the intellectual property rights of others and expects users of the Services to do the same. We will respond to notices of alleged copyright infringement that comply with applicable law and are properly provided to us. If you believe that your Content has been copied in a way that constitutes copyright infringement, please provide us with the following information: (i) a physical or electronic signature of the copyright owner or a person authorised to act on their behalf; (ii) identification of the copyrighted work claimed to have been infringed; (iii) identification of the material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled, and information reasonably sufficient to permit us to locate the material; (iv) your contact information, including your address, telephone number, and an email address; (v) a statement by you that you have a good faith belief that use of the material in the manner complained of is not authorised by the copyright owner, its agent, or the law; and (vi) a statement that the information in the notification is accurate, and that you are authorised to act on behalf of the copyright owner.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>13.2</b> We reserve the right to remove Content alleged to be infringing without prior notice, at our sole discretion, and without liability to you. In appropriate circumstances, we will also terminate a user's account if the user is determined to be a repeat infringer. Our address for notice of alleged copyright infringement appearing on the Services is
                        <!-- -->
                        <a class="link__2C7vA" href="mailto:support@bossjob.com" target="_blank" rel="noopener noreferrer">support@bossjob.com</a>.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">14. Use of the services</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>14.1</b> We reserve the right at all times (but will not have an obligation) to remove or refuse to distribute any Content on the Services , to suspend or terminate users, and to reclaim usernames without liability to you. We also reserve the right to access, read, preserve, and disclose any information as we reasonably believe is necessary to (i) satisfy any applicable law, regulation, legal process or governmental request, (ii) enforce the Terms of Service, including investigation of potential violations hereof, (iii) detect, prevent, or otherwise address fraud, security or technical issues, (iv) respond to user support requests, or (v) protect the rights, property or safety of Bossjob users and the public.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>14.2</b> We do not guarantee that our Services will be secure or free from bugs or viruses. You are responsible for configuring your information technology, computer programmes and platform in order to access our site. You should use your own virus protection software.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>14.3</b> You may not do any of the following while accessing or using the Services: (i) access, tamper with, or use non-public areas of the Services, Bossjob's computer systems, or the technical delivery systems of Bossjob's providers; (ii) probe, scan, or test the vulnerability of any system or network or breach or circumvent any security or authentication measures; (iii) access or search or attempt to access or search the Services by any means (automated or otherwise) other than through our currently available, published interfaces that are provided by us (and only pursuant to those terms and conditions), (scraping the Services without our prior consent is expressly prohibited); (iv) forge any TCP/IP packet header or any part of the header information in any email or posting, or in any way use the Services to send altered, deceptive or false source-identifying information; or (v) interfere with, or disrupt, (or attempt to do so), the access of any user, host or network, including, without limitation, sending a virus, trojan, worm, logic bomb or other material which is malicious or technologically harmful, overloading, flooding, spamming, mail-bombing the Services, or by scripting the creation of Content in such a manner as to interfere with or create an undue burden on the Services.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>14.4</b> We will report any such breach to the relevant law enforcement authorities and we will co-operate with those authorities by disclosing your identity to them. In the event of such a breach, your right to use our Services will cease immediately.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">15. Linking to us</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">You may link to our Services provided you do so in a way that is fair and legal and does not damage our reputation or take advantage of it. You must not establish a link in such a way as to suggest any form of association, approval or endorsement on our part where none exists. You must not establish a link to our Services in any website that is not owned by you. We reserve the right to withdraw linking permission without notice.</p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">16. Third party links and resources in our site</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>16.1</b> The links from the Services may take you to other sites or services and you acknowledge and agree that Bossjob has no responsibility for the accuracy or availability of any Information provided by third parties services and websites.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>16.2</b> The Services may include advertisements, which may be targeted to the Content or information on the Services, queries made through the Services, or other information. The types and extent of advertising by Bossjob on the Services are subject to change. In consideration for us granting you access to and use of the Services, you agree that Bossjob and its third party providers and partners may place such advertising on the Services or in connection with the display of Content or information from the Services whether submitted by you or others.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>16.3</b> Links to other websites and services do not constitute an endorsement by us of such websites or services, or the Information, products, advertising or other materials available made available by such third parties.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">17. Indemnity</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">You agree to defend, indemnify and hold us harmless from and against all liabilities, damages, claims, actions, costs and expenses (including without limitation legal fees), in connection with or arising from your breach of any of these Terms of Service and/or your use of the website. We may, if necessary, participate in the defence of any claim or action and any negotiations for settlement. No settlement which may adversely affect our rights or obligations shall be made without our prior written approval. We reserve the right, at our own expense and on notice to you, to assume exclusive defence and control of any claim or action.</p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">18. Severance</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">The illegality, invalidity or unenforceability of any provision of these Terms of Service under the law of any jurisdiction shall not affect its legality, validity or enforceability under the laws of any other jurisdiction nor the legality, validity or enforceability of any other provision.</p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">19. Several users</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">If there are two or more persons adhering to these Terms of Service as user, their liability under the Terms of Service is joint and several, and their rights are joint.</p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">20. Waiver</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">No failure or delay by a party to exercise any right or remedy provided under this agreement or by law shall constitute a waiver of that or any other right or remedy, nor shall it prevent or restrict the further exercise of that or any other right or remedy. No single or partial exercise of such right or remedy shall prevent or restrict the further exercise of that or any other right or remedy.</p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">21. Termination</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>21.1</b> The Terms of Service will continue to apply until terminated by either you or us as follows.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>21.2</b> You may end your agreement with us at any time for any reason by deactivating your accounts and discontinuing your use of the Services. You do not need to specifically inform us when you stop using the Services.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>21.3</b> We may suspend or terminate your accounts or cease providing you with all or part of the Services at any time for any reason, including, but not limited to, if we reasonably believe: (i) you have violated these Terms of Service or (ii) you create risk or possible legal exposure for us; or (iii) our provision of the Services to you is no longer commercially viable. We will make reasonable efforts to notify you by the email address associated with your account or the next time you attempt to access your account.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>21.4</b> In all such cases, any provision of these Terms of Service that expressly or by implication is intended to come into or continue in force on or after termination of this agreement shall remain in full force and effect.
                        </p>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">
                        <b>21.5</b> Nothing in this section shall affect our rights to change, limit or stop the provision of the Services without prior notice, as provided above in Clause 5 <b>Changes to our services</b>.
                        </p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">22. Governing law and jurisdiction</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">These Terms of Service shall be governed by Singapore law. You agree to submit to the exclusive jurisdiction of the Singapore courts.</p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">23. Languages</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">This agreement is drafted in the English language. If this agreement is translated into any other language, the English language version shall prevail.</p>
                        <div>
                        <h4 class="text__3yL_E textBase__k7xsv textWaterBlue__2nNyj textH4 linkText__1LCr7">24. Contact us</h4>
                        </div>
                        <p class="text__3yL_E textBase__k7xsv textP__1Apor">If you require further information about Bossjob or have any suggestions concerning how to improve our Services or Platforms, please contact us at
                        <!-- -->
                        <a class="link__2C7vA" href="mailto:support@bossjob.com" target="_blank" rel="noopener noreferrer">support@bossjob.com</a>.
                        </p>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    import { Form, Field, ErrorMessage } from 'vee-validate';
    import * as yup from 'yup';
    import vSelect from 'vue-select'

    export default {
    components: {
        Form,
        Field,
        ErrorMessage,
        vSelect
    },
   
    data() {
       
        const schema = yup.object({
            firstname: yup.string().required("required field"),
            lastname: yup.string().required("required field"),
            email: yup.string().required("must be a valid email").email(),
            password: yup.string().required().min(6),
            agree : yup.bool().required("You need to accept"),
         
            
        });

        return {
            schema,
            hidepass : true,
            isShow : true,
            modalShowTerms : false,
            modalShowPrivacy : false,
            preloading : true ,
            country : 'Select Country',
            countryError : false,
            countryList : []
        };
    },
    methods: {
        toggleShow() {
            this.hidepass = !this.hidepass;
        },
        registerModel(values , actions) { 
            
            if(this.country == "" || this.country == null){
                this.countryError = !this.countryError
                return false
            }
        
            values.country_code = this.country;
            values.type = 'M';
            // reset if no errors on registration
           //this.$refs.form.resetForm();
          
           
            axios.post("/api/register" ,values)
            .then(response =>{
                
               if(response.data.has_error){
                    //error message from api
                    const errorApi = {
                        email  : response.data.message
                    };

                    //set multiple errors
                    actions.setErrors(
                        errorApi
                    );
               } else{
                //alert("wala")
               }
            });
            
        },
        modalTerms () {
            this.$store.commit("setModalTerms", !this.modalShowTerms);
        },
        modalPrivacy () {
            this.$store.commit("setModalPrivacy", !this.modalShowPrivacy);
        },

    },
    mounted () {
        this.$nextTick(function () {
            this.preloading = !this.preloading 
        })

        axios.get("/api/country").then(response =>{
            this.countryList = response.data
        }); 
    }
};
</script>

<style scoped>

    .icon-a{
        background-color:var(--theme);
        color: #fff;
        width: 50px;
        text-align: center;
        border-radius: 30px;
    }

    .eye-icon{
        margin-top:10px;
        width : fit-content
    }
    .col-12{
        margin-bottom: 2rem;
    }

    .errormessage{
        margin-left: 1rem;
        font-weight: italic;
    }

    .navbar-light {
        margin-bottom : 5rem
    }

    .input-group-text{
        background-color: var(--theme) !important ;
    }
	.navigations:hover {color:var(--theme)}



</style>