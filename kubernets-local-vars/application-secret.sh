kubectl create secret generic library-api-variables \
  --from-literal=APP_KEY='base64:a89Bj62VIrzfDCsb3m8BNU+JedVKtEZEmqif25fR2g0=' \
  --from-literal=DB_PORT=3306 \
  --from-literal=DB_USERNAME='root' \
  --from-literal=DB_DATABASE='library_admin' \
  --from-literal=DB_PASSWORD='testes' \
  --from-literal=DB_HOST='mysql-service' \
  --from-literal=REDIS_HOST='redis-service' \
  --from-literal=REDIS_PORT=6380 \
  --from-literal=REDIS_PASSWORD='testes' \
  --from-literal=CACHE_DRIVER='redis' \
  --from-literal=SESSION_DRIVER='redis' \
  --from-literal=LOG_CHANNEL='stderr' 
  
# kubetpl render /srv/others/library_api/kubernets-local-vars/sitezao-deployment.yaml -i /srv/others/environment-local-items-pipeline/configs/library_api/local.env -x=$ | sed 's/ftdregistry.azurecr.io/repo-registry-local.ftd.com.br:5000/g' $1 |  kubectl apply -f -
