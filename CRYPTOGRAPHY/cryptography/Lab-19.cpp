#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <errno.h>
#include <windows.h>
void malicious_payload() {
    const char *filename = "C:\\Users\\PC\\Documents\\prime college\\Fifth Semester\\samyak manandhar\\CRYPTOGRAPHY\\secret.txt"; // Corrected path
    if (DeleteFileA(filename)) {
        printf("File '%s' deleted successfully.\n", filename);
    } else {
        printf("Error deleting file '%s': %d\n", filename, GetLastError());
    }
}
int main(int argc, char *argv[]) {
    if (argc > 1 && strcmp(argv[1], "--help") == 0) {
        printf("This program does something helpful... (or so it seems)\n");
        return 0;
    }
    if (argc > 1 && strcmp(argv[1], "--malicious") == 0) {
        malicious_payload();
    }
    printf("Program executed normally.\n");
    printf("SAMYAK MANANDHAR 79010513");
    return 0;
}
