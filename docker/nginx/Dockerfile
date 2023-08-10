FROM nginx:1.24.0-alpine

# タイムゾーン(東京)
ENV TZ Asia/Tokyo

# nginxのconfigファイル(default.conf)をコピー
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# このコンテナに入った時のカレントディレクトリ
WORKDIR /data