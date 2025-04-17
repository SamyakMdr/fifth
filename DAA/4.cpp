#include <stdio.h>
#include <stdlib.h>
#include <time.h>
void bubbleSort(int arr[], int n) {
    int i, j, temp, swaps = 0;
    for (i = 0; i < n - 1; i++) {
        for (j = 0; j < n - i - 1; j++) {
            if (arr[j] > arr[j + 1]) {
                temp = arr[j];
                arr[j] = arr[j + 1];
                arr[j + 1] = temp;
                swaps++;
            }
        }
    }
    printf("Sorted Array: ");
    for (i = 0; i < n; i++) {
        printf("%d ", arr[i]);
    }
    printf("\nNumber of swaps: %d\n", swaps);
}
int generateRandom(int lower, int upper) {
    return (rand() % (upper - lower + 1)) + lower;
}
int main() {
    int arr[10];
    char choice;
    srand(time(0));
    do {
        printf("Original Array: ");
        for (int i = 0; i < 10; i++) {
            arr[i] = generateRandom(1, 100);
            printf("%d ", arr[i]);
        }
        printf("\n");
        bubbleSort(arr, 10);
        printf("Do you want to sort another array? (y/n): ");
        scanf(" %c", &choice);
    } while (choice == 'y' || choice == 'Y');
    printf("Exiting the program!\n");
    return 0;
}
