#include <stdio.h>
#include <stdlib.h>
#include <time.h>

int merges = 0;

void merge(int arr[], int l, int m, int r) {
    int i, j, k;
    int n1 = m - l + 1;
    int n2 = r - m;

    int L[50], R[50]; // enough for small arrays

    for (i = 0; i < n1; i++)
        L[i] = arr[l + i];
    for (j = 0; j < n2; j++)
        R[j] = arr[m + 1 + j];

    i = 0; j = 0; k = l;

    while (i < n1 && j < n2) {
        if (L[i] <= R[j])
            arr[k++] = L[i++];
        else
            arr[k++] = R[j++];
    }

    while (i < n1)
        arr[k++] = L[i++];
    while (j < n2)
        arr[k++] = R[j++];

    merges++;
}

void mergeSort(int arr[], int l, int r) {
    if (l < r) {
        int m = (l + r) / 2;
        mergeSort(arr, l, m);
        mergeSort(arr, m + 1, r);
        merge(arr, l, m, r);
    }
}

int generateRandom(int lower, int upper) {
    return (rand() % (upper - lower + 1)) + lower;
}

int main() {
    int arr[20];
    char choice;
    srand(time(0));

    do {
        merges = 0;
        printf("Original Array: ");
        for (int i = 0; i < 20; i++) {
            arr[i] = generateRandom(1, 100);
            printf("%d ", arr[i]);
        }
        printf("\n");

        mergeSort(arr, 0, 19);

        printf("Sorted Array: ");
        for (int i = 0; i < 20; i++) {
            printf("%d ", arr[i]);
        }
        printf("\nNumber of merge operations: %d\n", merges);

        printf("Do you want to sort another array? (y/n): ");
        scanf(" %c", &choice);
    } while (choice == 'y' || choice == 'Y');

    printf("Exiting the program!\n");
    return 0;
}
