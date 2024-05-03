 <section class="background-radial-gradient overflow-auto">
   <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
     <div class="row gx-lg-5 align-items-center mb-5">
       <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
         <h1 class="mt-3 mb-3 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
           Welcome to <br />
           <span style="color: hsl(132, 81%, 75%)">Contact App Manager</span>
         </h1>
         <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 95%)">
           Store and Manage your Phone Contact here!
         </p>
       </div>

       <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
         <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
         <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
         <div id="radius-shape-3" class="position-absolute shadow-5-strong"></div>
         <div class="card bg-glass">
           <div class="card-body px-4 py-5 px-md-5">
             <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
             <form action="<?= urlpath('register') ?>" method="post">
               <div class="form-outline mt-5 mb-3">
                 <input type="text" id="full_name" name="full_name" class="form-control" required />
                 <label class="" for="full_name">Nama Anda</label>
               </div>
               <div class="form-outline mb-3">
                 <input type="tel" id="phone" class="form-control" name="phone" required />
                 <label class="" for="phone">Nomor HP</label>
               </div>
               <div class="form-outline mb-3">
                 <input type="email" id="email" class="form-control" name="email" required />
                 <label class="" for="email">Alamat Email</label>
               </div>
               <div class="form-outline mb-3">
                 <input type="text" id="username" class="form-control" name="username" required />
                 <label class="" for="username">Username</label>
               </div>
               <div class="form-outline mb-3">
                 <input type="password" id="password" class="form-control" name="password" required />
                 <label class="" for="password">Password</label>
               </div>
               <input type="submit" value="Register" class="btn btn-primary btn-block mb-4 form-control">
             </form>
             <p class="text-center mt-3 text-secondary">
               If you have account, Please <a href="<?= urlpath('login') ?>">Login Now</a>
             </p>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>