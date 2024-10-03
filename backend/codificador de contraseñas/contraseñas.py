import hashlib

texto = "Qdl01"
hash_md5 = hashlib.md5(texto.encode()).hexdigest()
print(hash_md5)