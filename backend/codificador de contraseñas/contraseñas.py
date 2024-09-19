import hashlib

texto = "Bqp8956"
hash_md5 = hashlib.md5(texto.encode()).hexdigest()
print(hash_md5)