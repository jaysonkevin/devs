<template>

   <nav class="navbar navbar-expand-md nav-header-theme bg-light fixed-top-nav">
      <div class="container">
        <router-link :to="'/'" ><img :src="'/image/logo.png'" height="150" class="logo-img" style="margin-bottom:-80px;"  /></router-link>
      </div>
   </nav>
<div class="bg-light">
  <div class="container py-5">
    <div class="row h-100 align-items-center py-5">
      <div class="col-lg-6">
        <h1 class="display-4">About Freelance </h1>

        <p>
         Freelance is a software solution that helps aspriring fashion models and companies to link each other as easy as possible around the world.

         For further information, contact us at <b>freelancing@gmail.com</b>.
        </p>
      </div>
      <div class="col-lg-6 d-none d-lg-block"><img src="https://bootstrapious.com/i/snippets/sn-about/illus.png" alt="" class="img-fluid"></div>
    </div>
  </div>
</div>

<footer class="bg-light pb-5">
  <div class="container text-center">
    <p class="font-italic text-muted mb-0">&copy; Copyrights freelance.com All rights reserved.</p>
  </div>
</footer>

</template>
<style>
.home-text{
   color:inherit;
}

</style>