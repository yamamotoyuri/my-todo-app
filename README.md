# ToDo App 設計書

## 1. システム概要

ユーザーがタスクを管理するための Web アプリケーション。
React で操作し、Laravel API を通じてデータベース(MySQL)に保存する。

## 2. 機能要件

- タスクの参照・作成・完了切り替え・削除
- タスク一覧の Excel 出力 (予定)
- タスク一覧の PDF 出力 (予定)

## 3. API エンドポイント一覧 (API Specification)

すべてのリクエストのベース URL: `http://localhost/api`

| メソッド | エンドポイント        | 内容         | リクエスト(JSON)    | レスポンス(JSON)                              |
| :------- | :-------------------- | :----------- | :------------------ | :-------------------------------------------- |
| `GET`    | `/tasks`              | 全タスク取得 | なし                | `[{"id":1, "title":"...", "is_done":0}, ...]` |
| `POST`   | `/tasks`              | タスク作成   | `{"title": "名前"}` | 作成された Task オブジェクト                  |
| `PATCH`  | `/tasks/{id}`         | 完了状態更新 | `{"is_done": true}` | 更新された Task オブジェクト                  |
| `DELETE` | `/tasks/{id}`         | タスク削除   | なし                | `{"message": "Deleted"}`                      |
| `GET`    | `/tasks/export/excel` | Excel 出力   | なし                | Excel ファイル(binary)                        |
| `GET`    | `/tasks/export/pdf`   | PDF 出力     | なし                | PDF ファイル(binary)                          |

## 4. データベース設計 (Schema)

### tasks テーブル

| カラム     | 型        | 制約               | 説明                          |
| :--------- | :-------- | :----------------- | :---------------------------- |
| id         | bigint    | PK, Auto Increment | タスク ID                     |
| title      | string    | Not Null           | タスク名                      |
| is_done    | boolean   | Default: false     | 完了フラグ (0:未完了, 1:完了) |
| created_at | timestamp | -                  | 作成日時                      |
| updated_at | timestamp | -                  | 更新日時                      |

## 5. 通信フロー

1. React (Axios) が API へリクエストを送信。
2. Laravel (Controller) がリクエストを受け取り、DB を操作。
3. Laravel が結果を JSON 形式で返却。
4. React が状態(State)を更新し、画面に反映。
