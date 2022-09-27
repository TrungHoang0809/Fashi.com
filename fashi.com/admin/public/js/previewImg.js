$(document).ready(function () {
  $("ul#preview li .add-file-btn").click(function () {
    $("input[type='file']#product-thumb").click();
  });

  $("input[type='file']#product-thumb").on('change', function (e) {
    let htmlString = "";
    let totalFilesUploading = $(this).get(0).files.length;
    for (let i = 0; i < totalFilesUploading; i++) {
      let img_src = URL.createObjectURL(event.target.files[i]);
      htmlString += `<li>
                        <div class="img-box">
                          <img src="${img_src}">
                          <div class="black-bg">
                            <div class="remove-img-btn" data-name="${this.files.item(i).name}">
                              <span>
                                <i class="fa-solid fa-xmark"></i>
                              </span>
                            </div>
                          </div>
                          <div class="thumb-role-txt ">
                          </div>
                        </div>
                      </li>`
    }
    $('ul#preview').append(htmlString);
  });

  $(document).ready(function () {
    $(".preview .add-file-btn").click(function () {
      $("input[type='file']#post-thumb").click();
    });

    $("input[type='file']#post-thumb").on('change', function (e) {
      let htmlString = "";
      let img_src = URL.createObjectURL(e.target.files[0]);
      htmlString += `<div class="post-thumb-container">
                        <div class="black-bg">
                          <div class="change-img-btn">
                            <span><i class="fa-solid fa-pen"></i></span>
                          </div>
                        </div>
                        <img src="${img_src}" alt="">
                      </div>`
      $('.preview').html(htmlString);
    });

    $(document).on('click', ".preview .black-bg", function () {
      $("input[type='file']#post-thumb").click();
    });
  })

  $(document).on('click', 'ul#preview li .remove-img-btn', function (event) {
    var liElement = event.target.closest('li');
    if (liElement) {
      liElement.remove();
    }
  })
});