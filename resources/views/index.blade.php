<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<script src="https://cdn.tailwindcss.com"></script>
<style>
   * {
      box-sizing: border-box;
   }
   body {
      margin: 0;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
   }
   nav {
      font-size: 20px;
      background-color: rgb(136, 22, 182);
      color: #cccccc;
      height: 75px;
   }
   
   ul {
      position: fixed;
      right:10px;
   }
   ul li {
      display: inline;
      padding-right: 30px;
      font-weight: 500;
      color: rgb(251, 255, 0);
   }

   .background-image{
    background-image: url("pic/lappy.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    height: 600px;

   }

   .logo {
      width: 75%;
      margin-left: auto;
      margin-right: auto;
      color: white;
      float: left;
      font-size: 30px;
      padding-left: 20px;
      padding-top: 20px;
   }
   .blog {
      margin-top: 20px;
      width: 75%;
      margin-left: auto;
      margin-right: auto;
      height: 400px;
   }
   .post {
      margin-top: 20px;
      float: left;
   }
   .blogHeader {
      font-size: 36px;
      margin-bottom: 20px;
   }
   .links {
      float: right;
   }
   .links li {
      color: black;
   }
   
</style>
</head>
<body>
<nav>
<div class="logo">
 LOGO 
</div>
<ul>
<li>Home</li>
<li>About</li>
<li>Contact</li>
</ul>
</nav>
<div class="blog">
<div class="post">
<div class="blogHeader">
<h2 class=" m-auto sm:m-auto text-left w-4/5 block">Do You want to become a developer?</h2>
</div>

<div class="blog-body">
<br><br>
<img src="pic/lappy.jpg" alt=""><br><br>
<p class="py-8 text-gray-500 text-s">
  Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
  Omnis tempora optio 
  dignissimos id laborum reiciendis itaque suscipit. Perspiciatis,
   saepe nostrum quia nihil praesentium dolore, 
  illum beatae, eos iure culpa ipsa?
</p>
<a href="/blog"
class="uppercase bg-blue-500 text-gray-100 text-s font-extrabold
py-3 px-8 rounded-3xl">Find Out More</a>
<br><br>
<hr>

</div>
</div>
</div>

<div class="blog">
  <div class="post">
  <div class="blogHeader">
    <h2 class=" text-4xl sm:m-auto text-left w-4/5 block">Are you struggling to be a better developer?</h2>
  </div>
  
  <div class="blog-body">
  
  <img src="pic/lappy.jpg" alt=""><br><br>
  <p class="py-8 text-gray-500 text-s">
    Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
    Omnis tempora optio 
    dignissimos id laborum reiciendis itaque suscipit. Perspiciatis,
     saepe nostrum quia nihil praesentium dolore, 
    illum beatae, eos iure culpa ipsa?
  </p>

  <p class="font-extrabold text-gray-600 text-s pb-9">
    Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
    Omnis tempora optio dignissimos id laborum reiciendis 
  </p>
  <a href="/blog" class="uppercase bg-blue-500 text-gray-100 text-s font-extrabold
  py-3 px-8 rounded-3xl">Find Out More</a>
  <br><br>
  <hr>

  <div class="text-center p-15 pb-10 pt-10 bg-black text-white">
    <h2 class="text-2xl pb-5 text-l">
        I'm An Expert In...
    </h2>
    <span class="text-extrabold block text-4xl py-1">
      UX Design
    </span>
    <span class="text-extrabold block text-4xl py-1">
      Project Management
    </span>
    <span class="text-extrabold block text-4xl py-1">
      Digital Strategy
    </span>
    <span class="text-extrabold block text-4xl py-1">
      Backend Development
    </span>
</div>
<div class="text-center pt-5 py-15">
   <span class="text-uppercase text-10 text-gray-400">
      Blog
   </span>
   <h2 class="text-4xl font-bold py-10">
      Recent Posts
   </h2>

   <p class="m-auto w-4/5 text-gray-500">
      Lorem ipsum dolor sit amet consectetur adipisicing elit.
       Labore dolore accusantium eius corporis quasi enim esse maiores,
        
   </p>
</div>
<div class="sm:grid grid-cols-2 w-4/5 m-auto">
<div class="flex bg-yellow-700 text-gray-100 pt-10">
   <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block">
      <span class="uppercase text-xs">
         PHP
      </span>
      <h3 class="text-xl font-bold py-10">
         Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          Quis, laudantium nostrum nemo impedit iure sapiente ullam 
          earum suscipit porro fuga! Tempore,
           iste! Culpa nihil perspiciatis,
          aliquid rem distinctio hic illo.

      </h3>
      <a 
      href="" class="uppercase bg-transparent border-2 boeder-gray-100 
      text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
         Find Out More
      </a>

   </div>
</div>
<div>
   <img src="pic/lappy.jpg" alt="">
</div>
</div>
<br><br>
  </div>
  </div>
  </div>
</body>

</html>
