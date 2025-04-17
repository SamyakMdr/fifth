#include <stdio.h>
#include <ctype.h>
#include <string.h> 

int main() {
    char text[500], ch;
    int key;
    printf("Enter a message to encrypt: ");
    fgets(text, sizeof(text), stdin);  
    text[strcspn(text, "\n")] = 0;
    printf("Enter the key: ");
    scanf("%d", &key);
    for (int i = 0; text[i] != '\0'; ++i) {
        ch = text[i];
        if (isalnum(ch)) {
            if (islower(ch)) {
                ch = (ch - 'a' + key) % 26 + 'a';
            }
            if (isupper(ch)) {
                ch = (ch - 'A' + key) % 26 + 'A';
            }
            if (isdigit(ch)) {
                ch = (ch - '0' + key) % 10 + '0';
            }
        }
        text[i] = ch;
    }
    printf("Encrypted message: %s", text);
    return 0;
}
