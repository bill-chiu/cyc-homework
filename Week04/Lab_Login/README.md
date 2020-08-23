用_SESSION完成登入系統

    額外功能:
        SESSION紀錄登入/驗證碼 可以自由登出 登入 新增/修改帳號


    操作流程:
        /Week04/Lab_Login/myschool.txt 複製sql 並輸入到資料庫

        index 可以選擇管理資料或是登入 若是沒登入 顯示This page for member only. 並選擇登入或是回首頁
        選擇登入介面後 需輸入帳密 (測試用帳密:jay / 1234 or jolin / 1234)

            若沒輸入 顯示 使用者名稱或密碼未輸入!

            若帳密錯誤 顯示 使用者名稱或密碼錯誤!
            
            若驗證碼錯誤 顯示 驗證碼錯誤!
        
        正確輸入之後 回到首頁，可以看到已經紀錄您的ID
        
        此時選擇管理資料 可以順利進入

        之後回到首頁 再選擇登出 SESSION 被清掉

        再次選擇管理資料 顯示This page for member only.
        