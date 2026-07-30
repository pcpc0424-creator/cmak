# 콘텐츠 스냅샷

관리자 화면에서 편집하는 콘텐츠는 DB에만 있고 코드 커밋에 남지 않는다.
서버 이전이나 DB 롤백 시 통째로 사라지므로, 작업 구간마다 이 덤프를 갱신해 함께 커밋한다.

## 포함 테이블

| 테이블 | 내용 |
|---|---|
| `page_contents` | 협회업무·협회소개·CM 소개 편집 페이지 본문 (지회 전국지도 도표 포함) |
| `english_contents` | 영문 페이지 본문 |
| `english_items` | 영문 페이지 리스트 항목 (인덱스 II-1~II-5 섹션 포함) |
| `home_cards` | 인덱스 바로가기 카드 |
| `hero_slides` | 인덱스 히어로 슬라이드 |

게시물(`posts`)·첨부(`attachments`)·회원 데이터는 양이 커서 제외한다. 이쪽은 전체 DB 백업으로 관리한다.

## 갱신

```bash
cd /var/www/cmak
DBPW=$(grep -E "^DB_PASSWORD=" .env | cut -d= -f2- | tr -d '"')
mysqldump -h127.0.0.1 -ucmak -p"$DBPW" --no-tablespaces --skip-add-locks \
  --skip-comments --complete-insert --default-character-set=utf8mb4 \
  cmak page_contents english_contents english_items home_cards hero_slides \
  > database/snapshots/site_contents.sql
```

## 복원

DROP TABLE + CREATE TABLE 이 들어 있어 해당 5개 테이블을 통째로 덮어쓴다.
복원 후 관리자 화면에서 편집한 내용은 스냅샷 시점으로 되돌아가므로 반드시 현재 상태를 먼저 백업할 것.

```bash
mysql -h127.0.0.1 -ucmak -p"$DBPW" cmak < database/snapshots/site_contents.sql
php artisan optimize:clear
chown -R www-data:www-data storage bootstrap/cache
```
