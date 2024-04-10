/*!
* Start Bootstrap - Blog Post v5.0.9 (https://startbootstrap.com/template/blog-post)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-blog-post/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

document.querySelectorAll('.toggle-replies').forEach(button => {
    button.addEventListener('click', function() {
        let nestedComments = this.closest('.comment').querySelector('.nested-comments');
        nestedComments.classList.toggle('d-none');
    });
});
