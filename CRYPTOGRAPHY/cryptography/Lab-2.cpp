#include <stdio.h>
#include <ctype.h>
#include <string.h> 
char decryptChar(char ch, int key) {
    if (isalpha(ch)) {
        char base = islower(ch) ? 'a' : 'A';
        return (char)(((ch - base - key + 26) % 26) + base); 
    } else if (isdigit(ch)) {
        return (char)(((ch - '0' - key + 10) % 10) + '0'); 
    } else {
        return ch; 
    }
}
void decrypt(char *text, int key) {
    for (int i = 0; text[i] != '\0'; i++) {
        text[i] = decryptChar(text[i], key);
    }
}
int main() {
    char text[500]; 
    int key;
    printf("Enter the text: ");
    fgets(text, sizeof(text), stdin);  
    text[strcspn(text, "\n")] = 0;
    printf("Enter the key (shift value): ");
    scanf("%d", &key);
    printf("Encrypted text: %s\n", text);
    decrypt(text, key);
    printf("Decrypted text: %s\n", text);
    return 0;
}
