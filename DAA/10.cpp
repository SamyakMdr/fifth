#include <stdio.h>
#include <stdlib.h>
#include <time.h>
void selectionSort(int arr[], int n) {
    int i, j, min_idx, temp;
    for (i = 0; i < n - 1; i++) {
        min_idx = i;
        for (j = i + 1; j < n; j++) {
            if (arr[j] < arr[min_idx]) {
                min_idx = j;
            }
        }
        if (min_idx != i) {
            temp = arr[i];
            arr[i] = arr[min_idx];
            arr[min_idx] = temp;
        }
    }
}
int generateRandom(int lower, int upper) {
    return (rand() % (upper - lower + 1)) + lower;
}
int main() {
    int arr[20], k;
    char choice;
    srand(time(0));
    do {
        printf("Original Array: ");
        for (int i = 0; i < 20; i++) {
            arr[i] = generateRandom(1, 100);
            printf("%d ", arr[i]);
        }
        printf("\n");
        printf("Enter the value of k (1 to 20): ");
        scanf("%d", &k);
        if (k < 1 || k > 20) {
            printf("Invalid k! Please enter a value between 1 and 20.\n");
        } else {
            selectionSort(arr, 20);
            printf("Sorted Array: ");
            for (int i = 0; i < 20; i++) {
                printf("%d ", arr[i]);
            }
            printf("\nThe %d-th smallest element is: %d\n", k, arr[k - 1]);
        }
        printf("Do you want to find order statistic again? (y/n): ");
        scanf(" %c", &choice);
    } while (choice == 'y' || choice == 'Y');

    printf("Exiting the program!\n");
    return 0;
}