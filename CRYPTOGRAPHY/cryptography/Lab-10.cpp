#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define MOD 26

void getKeyMatrix(int key[2][2]) {
    key[0][0] = 3; key[0][1] = 3;
    key[1][0] = 2; key[1][1] = 5;
}

void textToNumbers(char text[], int numbers[], int len) {
    for (int i = 0; i < len; i++)
        numbers[i] = text[i] - 'A';
}

void numbersToText(int numbers[], char text[], int len) {
    for (int i = 0; i < len; i++)
        text[i] = numbers[i] + 'A';
    text[len] = '\0';
}

void multiplyMatrix(int key[2][2], int text[], int result[]) {
    for (int i = 0; i < 2; i++) {
        result[i] = (key[i][0] * text[0] + key[i][1] * text[1]) % MOD;
    }
}

int modInverse(int a, int mod) {
    for (int x = 1; x < mod; x++)
        if ((a * x) % mod == 1)
            return x;
    return -1;
}

void inverseKeyMatrix(int key[2][2], int invKey[2][2]) {
    int det = (key[0][0] * key[1][1] - key[0][1] * key[1][0]) % MOD;
    if (det < 0) det += MOD;
    int detInv = modInverse(det, MOD);
    
    invKey[0][0] = key[1][1] * detInv % MOD;
    invKey[0][1] = -key[0][1] * detInv % MOD;
    invKey[1][0] = -key[1][0] * detInv % MOD;
    invKey[1][1] = key[0][0] * detInv % MOD;
    
    for (int i = 0; i < 2; i++)
        for (int j = 0; j < 2; j++)
            if (invKey[i][j] < 0) invKey[i][j] += MOD;
}

void encrypt(char plain[], char cipher[]) {
    int key[2][2], text[2], enc[2];
    getKeyMatrix(key);
    textToNumbers(plain, text, 2);
    multiplyMatrix(key, text, enc);
    numbersToText(enc, cipher, 2);
}

void decrypt(char cipher[], char plain[]) {
    int key[2][2], invKey[2][2], text[2], dec[2];
    getKeyMatrix(key);
    inverseKeyMatrix(key, invKey);
    textToNumbers(cipher, text, 2);
    multiplyMatrix(invKey, text, dec);
    numbersToText(dec, plain, 2);
}

int main() {
    char plain[3], cipher[3], decrypted[3];
    printf("Enter a two-letter plaintext (A-Z): ");
    scanf("%2s", plain);
    
    encrypt(plain, cipher);
    decrypt(cipher, decrypted);
    
    printf("Plaintext: %s\n", plain);
    printf("Ciphertext: %s\n", cipher);
    printf("Decrypted: %s\n", decrypted);
    printf("Samyak Manandhar 79010513");
    return 0;
}
