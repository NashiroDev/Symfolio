def encrypt_cesar(plaintext, shift):
    ciphertext = ""
    for char in plaintext:
        if char.isalpha():
            shift_char = chr((ord(char.upper()) - 65 + shift) % 26 + 65)
            if char.islower():
                ciphertext += shift_char.lower()
            else:
                ciphertext += shift_char
        else:
            ciphertext += char
    return ciphertext


while True:
    plaintext = input("Entrez le message à crypter : ")
    shift = int(input("Entrez le décalage souhaité : "))

    ciphertext = encrypt_cesar(plaintext, shift)
    print("Message crypté :", ciphertext)
    
