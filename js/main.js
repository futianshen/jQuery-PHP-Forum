$(document).ready(function (e) {
  let postContent
  $('.update__post--modify').submit(function (e) {
    e.preventDefault()
    postContent = $(this).offsetParent('.post').find('.post__content').text()
    const postId = $(e.target).parent().find("[name=post_id]").val()
    $(e.target).offsetParent('.post__body').find('.post__content').replaceWith(`
      <form class="input__post--modify" action="function/modify_post.php" method="POST">
        <textarea name="modify_content" required="required">${postContent}</textarea>
        <input type="hidden" name="post_id" value="${postId}" />
        <input class="btn btn-info" type="submit" />
      </form>
    `)
  })
  $(document).on('submit', '.input__post--modify', function (e) {
    e.preventDefault()
    if(window.confirm('確定要修改嗎 ?')){
      const postId = $(e.target).parent().find("[name=post_id]").val()
      const modifyContent = $(e.target).parent().find("[name=modify_content]").val()
      $(this).parent().parent().find('.input__post--modify').replaceWith(`<p class="post__content card-text">${modifyContent}</p>`)
      $.ajax({
        type: "POST",
        url: 'function/modify_post.php',
        data: {
          post_id: postId,
          modify_content: modifyContent
        },
        success: function (res) {
          let resp = JSON.parse(res)
          console.log(resp.result)
        }
      })
    } else {
      $(this).parent().parent().find('.modify').replaceWith(`<p class="post__content card-text">${postContent}</p>`)
    }
  })

  $('.update__post--del').submit(function (e) {
    e.preventDefault()
    if(window.confirm('確定要刪除嗎？')) {
      const post_id = $(e.target).parent().find("[name=post_id]").val()
      $.ajax({
        type: "POST",
        url: 'function/del_post.php',
        data: {
          post_id: post_id,
        },
        success: function () {
          $(e.target).offsetParent('.post').remove()
        }
      })
    }
  })

  $('.input__comment').submit(function (e) {
    e.preventDefault()
    const commentContent = $(e.target).find("[name=comment_content]").val()
    const postId = $(e.target).find("[name=post_id]").val()
    $.ajax({
      type: "POST",
      url: 'function/comment.php',
      data: {
        comment_content: commentContent,
        post_id: postId,
      },
      success: function (resp) {
        let response = JSON.parse(resp)
        if (response.result === 'success') {
          if (response.highlight) {
            $(e.target).closest('.post__body').find('.comment').prepend(`
              <div class="comment__read card text-white bg-danger">
                <div class="comment__read--header card-header">
                  <div class="comment__read--info">
                    <div>${response.comment_nickname}</div>
                    <div>${response.comment_time}</div>
                  </div>
                  <div class="update update__comment">
                    <form class="update__comment--del"  action="function/del_comment.php" method="POST"> 
                        <input type="hidden" checked="checked" name="comment_id" value="${response.comment_id}" > 
                        <input type="submit" value="刪除" class='btn btn-danger'> 
                    </form>
                    <form class="update__comment--modify" action="function/modify_comment.php" method="POST"> 
                        <input type="hidden" checked="checked" name="comment_id" value="${response.comment_id}"" >
                        <input type="submit" value="修改" class='btn btn-warning'>
                    </form>
                  </div>
                </div>
                <div class="comment__read--main card-body">
                    <p class="comment__read--content card-text">${commentContent}</p>
                </div>
              </div>
          `)
          } else {
            $(e.target).closest('.post__body').find('.comment').prepend(`
              <div class="comment__read card border-primary">
                <div class="comment__read--header card-header">
                  <div class="comment__read--info">
                    <div>${response.comment_nickname}</div>
                    <div>${response.comment_time}</div>
                  </div>
                  <div class="update update__comment">
                    <form class="update__comment--del" action="function/del_comment.php" method="POST"> 
                        <input type="hidden" checked="checked" name="comment_id" value="${response.comment_id}" > 
                        <input type="submit" value="刪除" class='btn btn-danger'> 
                    </form>
                    <form class="update__comment--modify" action="function/modify_comment.php" method="POST"> 
                        <input type="hidden" checked="checked" name="comment_id" value="${response.comment_id}"" >
                        <input type="submit" value="修改" class='btn btn-warning'>
                    </form>
                  </div>
                </div>
                <div class="comment__read--main card-body">
                  <p class="comment__read--content card-text">${commentContent}</p>
                </div>
              </div> 
            `)
          }
          /* 將輸入框清空 */
          $(e.target).find(`[name='comment_content']`).val('')
        } else if (response.result === 'signup') {
          document.location.href = "index.html"
        }
      }
    })
  })

  $(document).on('submit', '.update__comment--modify', function (e) {
    e.preventDefault();
    const commentContent = $(e.target).offsetParent('.comment__read').find('.comment__read--content').text()
    const commentId = $(e.target).parent().find("input[name=comment_id]").val()
    $(e.target).offsetParent('.comment__read').find('.comment__read--content').replaceWith(`
      <form class="input__comment--modify" method="POST" action="function/modify_comment.php">
        <textarea name="modify_content" required="required" >${commentContent}</textarea>
        <input type="hidden" name="comment_id" value="${commentId}"/>
        <input class="modifyToComment btn btn-info" type="submit"/>
      </form>      
    `)
  })
  $(document).on('submit', '.input__comment--modify', function (e) {
    e.preventDefault()
    const commentId = $(e.target).parent().find("[name=comment_id]").val()
    const modifyContent = $(e.target).parent().find("[name=modify_content]").val()
    $.ajax({
      type: "POST",
      url: 'function/modify_comment.php',
      data: {
        comment_id: commentId,
        modify_content: modifyContent
      },
      success: function (resp) {
        let response = JSON.parse(resp)
        if (response.result === 'success') {
          $(e.target).offsetParent('comment__read').find('.input__comment--modify').replaceWith(`<p class="comment__read--content card-text">${modifyContent}</p>`)
        }
      }
    })
  })
  /* 刪除迴響 */
  $(document).on('submit', '.update__comment--del', function (e) {
    e.preventDefault()
    if(window.confirm('確定要刪除嗎 ？')) {
      const commentId = $(e.target).find("input[name=comment_id]").val()
      $.ajax({
        type: "POST",
        url: 'function/del_comment.php',
        data: {
          comment_id: commentId,
        },
        success: function () {
          $(e.target).offsetParent('comment__read').remove()
        }
      })
    }
  })
})
