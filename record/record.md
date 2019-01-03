### 模組化完成之後 重新測驗一次功能
看 ajax 和 後端內容有沒有同步
所有和 php 有關的東西都對照胡立貼的那個人的筆記
每解決一個問題重新錄影
怎樣讓程式文件化 命名很重要
迴圈取出留言和迴響的邏輯是不是可以交給 js 做 ？有沒有辦法將網頁中的 php 全部拿掉，php只做功能 ？ */
為什麼原來用 cookie 做 sesion 機制的時候要用 uniq 函式 ？ 因為會被其他人看到當不會被其他人看到就可以不用了 ？userid 存在 session 有沒有可能被掉包？ 一開始就被掉包有可能嗎？ session 什麼時候過期？ */
有沒有辦法讓選擇器短一點
留言板
關閉 conn stmt

### 今天複盤的時候回看這個筆記
### 將這個留言板搬到 github 和自己的主機上
- 將機密資料刪掉 .gitignore
- 怎樣將自己的這個專案搬到 github 上 ？

### 關於重構留言版今天我做了那些事 ？(181108)
1. 改變資料庫命名 把 tian 去掉
2. 確定修改資料庫之後 程式可以 work
3. 確定程式可以 work
4. 現在有那些問題要理清和解決

### 關於重構留言版今天我做了那些事 ？(181109) 把這個 bug 修理完就差不多了。成功解決可以刪除別人留言的問題。
### 整理測試自己的留言本安全清單 資安 刪除別人文章的問題
1. 想要同時使用 cookie 和 session ？什麼情況下需要同時使用 ? 他們分別擅長負責什麼功能？
2. 發現 cookie 不能使用探討原因 
3. 經過多方比較之後發現是因為路徑不一樣，從 zzly 之前第五周問的問題獲得證實。（需要整理成筆記）
4. 將 username 轉換成識別證存到資料庫。（前端的 ajax 和後端功能都要調整）
5. 在讀取的時候把資料 post_author 和 comment_author 拿出來，比對文章以及迴響作者，如果是同一個人才可以修改留言。 用什麼方法驗證？password_verify(())
6. 在發送留言修改的時候，只有 post_author = 現在登入使用者的才可以修改
7. 想刪除留言，必須讓是作者的使用者才可以將留言刪除，前端要表現不能刪除。

這樣的意思是不是，乾脆連 username 都存暗碼？haha

6. 修改留言的時候除了驗證 id 還可以做哪些驗證 ? author 怎麼驗證 ？ 
5. 把識別證 author 存到資料庫之後取出比對是相同的人，才可以修改留言。
8. 整理我做了什麼功能 ？投影片 如果讓我重新做一次。




### 有辦法引入 gulp 嗎 ？
### 關於重構留言版今天我做了那些事 ?

### 如何對自己做 code review ？先後步驟是什麼 ？
怎麼做 code review ？code review 心態 想像一下我要教別人 ？把所有微不足道的細節，為什麼要這樣做儘可能的說清楚。
我當初為什麼這樣做？這個方法好嗎 ？有沒有其他的方法 ？
這個命名的方式好理解嗎 ？在這裡命名的方法是蛇 ？還是駝峰 ？哪一種命名比較好搭配或區分 ？這個語言常用的命名方法是什麼？這裡的語義化命名做的好嗎？ 怎樣讓人一看就看懂。怎樣做到好的程式碼就是文件？
我可以怎樣調整我的程式碼 ？
把問題註記在程式碼上
有什麽新技術可以加入使用 ？用功能實做修改來補技術債

### 產品規格書 產品介紹
- overview 沒有太多複雜的功能
  - index 是用 html 寫的 
- 功能的結構
  - 在原來的帖子留言，會表示為特殊顏色。

- 資料庫結構 邏輯 可以讓資料庫幫你做的就讓資料庫幫你做
- 程式邏輯
  - 把功能的邏輯解釋清楚。
  - 我的排版方法
- 程式語言邏輯
- 前端怎麼發想
- 商業邏輯

- 使用哪些工具 ?
  - 配色
  - bootstrap

- 使用了哪些技術 ？
  - html 
  - css
    - stylus
  - js
    - jQuery

- 未來展望

### 待解決問題 ### 哪些搞不清楚的問題需要先解決 ？如果想到解法了就進行下一題 解決完這個問題差不多就可以整理了
1. [X] 可以刪除修改別人的留言和迴響的問題 （把解決這個問題的過程記錄下來，寫成一篇文章。）
  解決方法：加上 session 證明身份

  遇到問題，可以刪除修改別人的留言和迴響怎麼辦 ？儘量描述問題，越周全越好。
  資訊安全的假設：資料庫被拿走，程式全被看光
  資安金句；不要相信前端的資料
  - 為什麼對方要刪除別人的資料 ？
  - 對方是怎麼刪除我的資料的 ？
  - 如何防止對方刪除我的資料 ？
  誰才可以刪除別人的資料 ？通行證 ？加上一筆通行證 ？
  導致問題發生的原因 ？ 後端沒辦法判斷這個人是誰 ？後端端刪除機制是不是要改變 ? 後端要怎樣判斷前端的人是誰 ？我是不是忘了加上 session id ？原來是怎麼使用 session id 的 ？
  session 和 cookie 最大的差別是什麼 ？seesion機制的資料存在哪裡 ？ cookie 存在哪裡 ？所以從 session 和 cookie 到底差在哪裡 ？php set cookie 是存在哪裡 ？ 怎麼辨識身份？為什麼會產生問題這個問題 ？
  在登入的時候多給一組識別證亂數產生的識別證號碼。（這個意思是 session 嗎 ？）
  將這組識別證號碼對應到每一筆留言的作者，現在登入這個人的識別證，和文章作者的識別證相同，就可以刪除，否則顯示錯誤。
  怎麼將後端 session 的資料對應到資料庫中的資料 ？session 是存在後端的哪裡 ？後端分為那幾個部分？ 放網頁、session 的那個根目錄是後端的哪裡 ? appache ? 
  為什麼陌生人可以刪除別人的留言？路人可不可以 ？ 路人有沒有資格刪除 ？誰才有資格刪除 ？
  怎樣讓後端知道你不是陌生人 ？ 怎樣讓前端看不到你儲存的資料。

  - 我使用了這個方法之後，對方還可以刪除或修改我的資料嗎 ？怎麼做 ？
  - 後端是怎麼知道刪除那一個資料的 ？
  怎麼不透過前端傳資料讓後端知道要刪除那一留言 ? 
  怎麼讓前端只負責讓東西消失從畫面上消失，後端負責判斷應不應該刪除。
  子留言也有同樣問題，Ajax 貌似讓前端刪除了資料，但實際上後端是刪除到另一個資料。
  Ajax 的運作原理是什麼 ？Ajax 是怎麼運作的 ？將資料先顯示在畫面上，等下次刷新的時候，才將後端的資料抓取到畫面上。

  為什麼我要使用 Ajax ？增加使用者體驗 

  為什麼會有這個問題 ? 
  前端和後端資料不同步 ？
  怎樣讓後端與前端資料保持同步 ？
  我們是怎麼做到讓前後端保持同步的 ？後端和前端是怎麼保持同步的 ？
  前後端在什麼情況下需要保持同步 ？
  誰才有權限修改資料庫裡面的資料 ？
  後端 php 是怎麼將後端的網頁顯示在前端的 ？
  有什麽方法可以解決前端後端不同步的問題 ？
  怎樣解決別人可以刪除我的資料的問題 ？

2. 分頁功能（參考胡立week10 星期四的直播）如果要前後端拆分，怎麼用 JS 處理分頁 ？

  - 頁碼需要修正。哪些地方需要修正？
  - 如果分頁數量小於1 分頁區塊刪除


3. 如何將前後端拆分？前端使用 Ajax 撈資料 先瞭解一下 MVC 這樣是叫 SPA 還是 MVC
  - 前端
    - html 怎麼樣才可以不用有 php ？
    - css 怎麼拆分 
    - js功能怎麼拆分 ？

  後端
    - php 功能怎麼拆分？
原來用 PHP 做的事怎麼用 JS 做 ？

4. 前後端串接
  - 使用 DOM API
  - 使用 jQuery Ajax
  - 使用 Fetch API Promise 用 fetch API 串接 資料 怎麼做？看之前自己做的筆記。
- 我可不可以透過控制前端，在其他的留言迴響

5. 優化 jQuery 寫法
解決以上這 5 個問題就可以了。
接下來要做的就是把自己寫出來的這些東西全都搞清楚。
解不開的就留到問題清單裡面就好

### 我想要做到的功能 怎麼做 ？整理想做到的功能（列出優先級）還是這些功能其實可以一起做 ？
### 有時間的話可以做第5個不會太難
1. 註冊直接登入功能（可以和訪客查看功能一起做 ？）

2. 訪客查看功能 如何讓陌生人也可以瀏覽留言版 ？哪些權限需要封印 ？
  - 不登入的訪客可以查看，如果訪客按下留言，先把他的留言儲存起來請他註冊，註冊完之後直接把他的留言匯入。
  - 怎麼判斷他是不是訪客
  - 如果是訪客要執行什麼動作？儲存他的留言，請他註冊。
  - 如果註冊完成，直接登入，
  - isset empty 兩個語法應該可以幫到我的忙
  - 有沒有漏洞 ？
  - 要檢查哪些資安漏洞 ？
  - 怎麼確保沒有資安漏洞 ？
  - 或是就算有漏洞也不怕 ？

5. 外觀細節與效能優化
  - 自己留言的的外框 ajax 產生的 和 php 產生的要一達成一致
  - iconfont
  - DATA url
  - CSS Sprites
  - 統一留言版視覺風格
  - 註冊的響應式問題
  - 登入註冊失敗怎麼顯示錯誤訊息？
  - 留言

6. 重構 CSS bem 命名 會需要連同 js 一起修改

其他詳情請見 Evernote 第五周 第六周

- 自我問答
  - 留言就會回到 第一頁 這個機制好不好？

### 有那些工具可以使用 ？
- 內建函式
- 有沒有辦法加入 todolist 功能 ?
 
### 如果讓我重新做一次，我要怎麼做 ? 參考胡立這一周留言版的技巧與做法
我要問自己哪些問題 ？比對胡立的程式碼
- 切版
- 資料庫結構
如果重新設計一次資料庫結構我會怎麼做？is_deleted 預設值 設為 0
- 串接功能
- 檔案功能需要排列順序嗎 ？

### 想問的問題
- 工具的使用
  - 在 VS code 快速刪除文字的技巧 
  - PHP 可以 搭配使用 pug 嗎？ pug 什麼時候用 ？
- 程式邏輯 
  - 與後端傳資料要怎麼命名 ？
  - 把重新做一次留言版的流程整理出來之後，問胡立有沒有的地方可以優化 ？
  - 不是很能理解 huli 的方法 留言和子留言在一起是不是違反正規化 ？
- 求職
  - 如果想進遊戲業，那一些技術比較吃香 ？我還要繼續升級我的留言版程式碼嗎？
- 檔案管理
  - css 怎麼拆分 ？

其他問題：

### 想要整理的筆記
- 資訊安全檢查清單
- 怎麼使用 jQuery 使用 jQuery 的技巧
  使用步驟
  選擇器的使用如果沒有加動作就是監聽$('.selector'), $('#selector')
  1. 選取物件 有沒有一個簡單的又適合所有場景的選取方法（是在要選取的東西上面設定 class 嗎？） 選擇器要怎麽選？e.target? 設定 class ？哪裡有資料可以找？技術債 
    - 怎樣取出 input text 裡面的數值？
    - 怎樣選到 ul 下面 li 的 button ？

  2. 監聽事件
    - 我要監聽什麼事件？jQuery 選擇器一般往下選擇幾層 怎樣是好的方法？ 直接在要選擇的元素上 加上 class？
    - 我要監聽誰的動作？
      - 為什麼用 submit 抓不到 selector ？ 要選擇表單，不是選擇按鈕。 

  3. 執行動作 如果()內沒有東西就是截取，有東西就是賦值。
  - jQuery selector 怎樣寫比較簡潔 ？jQuery 的 選擇技巧。

- 怎麽使用 Fetch & Promise ? 為什麼要使用 Fetch 和 Promise ？
- Session 和 Cookie 機制的差別是什麼 ? 邏輯差別與實踐語法差別分別是什麼 Session 的資料存在哪裡？cookie 的資料存在哪裡 ？哪裡可能有答案，過去的作業，手機查的資料。
- DOM 什麼時候要用 e
e.target 和 this 有什麼差別？ 哪裡可能有答案 ？胡立的 todolist
- 為什麼 vanilla js 選不到自己製造的 DOM 節點 ？要用 on ？
 event delegation

- php
  - 什麼時候要使用 Prepare Statement 什麼時候不用使用 Prepare Statement
  - 什麼是 template string
  http://www.jollen.org/php/jollen_php_book_42.html

### 延伸問題 

### 什麼是 MVC ? 
php 和 js 拆開，理想狀態前端完全不用 php 我的這個想法是 MVC 嗎？如何將程式的各個功能單獨拆解出來？

### 這星期之後不碰留言版 ？
### 如何用 git 保存或回復今天的成果？
### Todo highliht 用 問題 做標籤（自定義 keyword 標籤）
- 回看所有註解 用 todo 標識顏色


### 完成一週作業的套路是什麽 ？
### 繳交一周作業前的套路是什麼 ？
- 整理作業
- 整理問題
- 整理心得


### 哪些功能可以用 cookie ？ 哪些功能一定要用 session ？
### 解題解不出來先休息 3 分鐘
### 再解半小時解不出來就換下一件事情做

``` php
/* 為什麼要存 user_id ? */
    /* 怎麼利用 session 過一段時間自動登出 */
    
  ```
### 怎樣確認自己對自己的作品夠熟練 ？
- 如果讓我重做一次我會怎麼做？
- 我做了哪些功能 ? 後端功能和前端功能
- 我為了做這些功能使用了哪些技術 ？

### 工程師一大能力，有系統化的命名。怎麼讓程式就是文件 ？