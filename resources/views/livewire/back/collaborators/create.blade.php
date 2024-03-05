<div>
    <div class="space-y-8">
        <div>
            <x-breadcrumb :page-title="'Nouveau collaborateur'" :breadcrumb-items="[
                  ['name' => 'Collaborateurs', 'url' => '', 'active' => false],
                ['name' => 'Nouveau', 'url' => '', 'active' => true],
            ]" />

        </div>

        <!-- START: Step Form Horizontal -->
        <div class="wizard card">
            <div class="card-header">
                <h4 class="card-title">form wizard</h4>
            </div>
            <div class="card-body p-6">
                <div class="wizard-steps flex z-[5] items-center relative justify-center md:mx-8">

                    <div class="pass relative z-[1] items-center item flex flex-start flex-1 last:flex-none group wizard-step active" data-step="1">
                      <div class="number-box">
                        <span class="number">
                          1
                      </span>
                        <span class="no-icon text-3xl">
                          <iconify-icon icon="bx:check-double"></iconify-icon>
                      </span>
                      </div>
                      <div class="bar-line"></div>
                      <div class="circle-box">
                        <span class="w-max">Account Details</span>
                      </div>
                    </div>

                    <div class="relative z-[1] items-center item flex flex-start flex-1 last:flex-none group wizard-step" data-step="1">
                      <div class="number-box">
                        <span class="number">
                          2
                      </span>
                        <span class="no-icon text-3xl">
                          <iconify-icon icon="bx:check-double"></iconify-icon>
                      </span>
                      </div>
                      <div class="bar-line"></div>
                      <div class="circle-box">
                        <span class="w-max">Personal info</span>
                      </div>
                    </div>

                    <div class="relative z-[1] items-center item flex flex-start flex-1 last:flex-none group wizard-step" data-step="1">
                      <div class="number-box">
                        <span class="number">
                          3
                      </span>
                        <span class="no-icon text-3xl">
                          <iconify-icon icon="bx:check-double"></iconify-icon>
                      </span>
                      </div>
                      <div class="bar-line"></div>
                      <div class="circle-box">
                        <span class="w-max">Address</span>
                      </div>
                    </div>

                    <div class="relative z-[1] items-center item flex flex-start flex-1 last:flex-none group wizard-step" data-step="1">
                      <div class="number-box">
                        <span class="number">
                          4
                      </span>
                        <span class="no-icon text-3xl">
                          <iconify-icon icon="bx:check-double"></iconify-icon>
                      </span>
                      </div>
                      <div class="bar-line"></div>
                      <div class="circle-box">
                        <span class="w-max">Address</span>
                      </div>
                    </div>

                  </div>
                <form class="wizard-form mt-10" action="#">
                    <div class="wizard-form-step active" data-step="1">
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
                            <div class="lg:col-span-3 md:col-span-2 col-span-1">
                                <h4 class="text-base text-slate-800 dark:text-slate-300 my-6">Enter Your Account Details</h4>
                            </div>
                            <div class="input-area">
                                <label for="username" class="form-label">User Name*</label>
                                <input id="username" type="text" class="form-control" placeholder="Username"></div>
                            <div class="input-area">
                                <label for="fullname" class="form-label">Full Name*</label>
                                <input id="fullname" type="text" class="form-control" placeholder="Full Name"></div>
                            <div class="input-area">
                                <label for="email" class="form-label">Email*</label>
                                <input id="email" type="text" class="form-control" placeholder="Enter Your Email"></div>
                            <div class="input-area">
                                <label for="phonenumber" class="form-label">Phone number*</label>
                                <input id="phonenumber" type="text" class="form-control" placeholder="Phone Number"></div>
                            <div class="input-area">
                                <label for="password" class="form-label">Password*</label>
                                <input id="password" type="password" class="form-control" placeholder="Password"></div>
                            <div class="input-area">
                                <label for="confirmPassword" class="form-label">Confirm Password*</label>
                                <input id="confirmPassword" type="password" class="form-control" placeholder="Confirm Password"></div>
                        </div>
                    </div>
                    <div class="wizard-form-step" data-step="2">
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
                            <div class="lg:col-span-3 md:col-span-2 col-span-1">
                                <h4 class="text-base text-slate-800 dark:text-slate-300 my-6">Personal Information</h4>
                            </div>
                            <div class="input-area">
                                <label for="firstname" class="form-label">First Name*</label>
                                <input id="firstname" type="text" class="form-control" placeholder="First"></div>
                            <div class="input-area">
                                <label for="lastname" class="form-label">Last Name*</label>
                                <input id="lastname" type="text" class="form-control" placeholder="Last Name"></div>
                        </div>
                    </div>
                    <div class="wizard-form-step" data-step="3">
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
                            <div class="lg:col-span-3 md:col-span-2 col-span-1">
                                <h4 class="text-base text-slate-800 dark:text-slate-300 my-6">Address</h4>
                            </div>
                            <div class="input-area lg:col-span-3 md:col-span-2 col-span-1">
                                <label for="address" class="form-label">Address*</label>
                                <textarea name="address" id="address" rows="3" class="form-control" placeholder="Your Address"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-form-step" data-step="4">
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
                            <div class="lg:col-span-3 md:col-span-2 col-span-1">
                                <h4 class="text-base text-slate-800 dark:text-slate-300 my-6">Social Links</h4>
                            </div>
                            <div class="input-area">
                                <label for="fblink" class="form-label">Facebook Link*</label>
                                <input id="fblink" type="url" class="form-control" placeholder="Facebook Link"></div>
                            <div class="input-area">
                                <label for="youtubelink" class="form-label">Youtube Link*</label>
                                <input id="youtubelink" type="url" class="form-control" placeholder="Youtube Link"></div>
                        </div>
                    </div>
                    <div class="mt-6   space-x-3">
                        <button class="btn btn-dark prev-button" type="button">précédent</button>
                        <button class="btn btn-dark next-button" type="button">Suivant</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END: Step Form Horizontal -->

    </div>
</div>
