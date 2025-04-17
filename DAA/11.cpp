#include <stdio.h>
#include <stdlib.h>
#include <string.h>
typedef struct {
    char id[5];
    int deadline;
    int profit;
} Job;
int min(int a, int b) {
    return (a < b) ? a : b;
}
int compare(const void* a, const void* b) {
    return ((Job*)b)->profit - ((Job*)a)->profit;
}
int main() {
    Job jobs[] = { {"J1", 2, 60}, {"J2", 1, 100}, {"J3", 3, 20}, {"J4", 2, 40}, {"J5", 1, 20} };
    int n = sizeof(jobs) / sizeof(jobs[0]);
    int result[n];
    int slot[n];
    memset(slot, 0, sizeof(slot));
    int totalProfit = 0;
    int loopCount = 0;
    qsort(jobs, n, sizeof(Job), compare);
    loopCount++;
    for (int i = 0; i < n; i++) {
        loopCount++;
        for (int j = min(n, jobs[i].deadline) - 1; j >= 0; j--) {
            loopCount++;
            if (!slot[j]) {
                result[j] = i;
                slot[j] = 1;
                totalProfit += jobs[i].profit;
                break;
            }
        }
    }
    printf("Scheduled Jobs: ");
    for (int i = 0; i < n; i++) {
        if (slot[i])
            printf("%s ", jobs[result[i]].id);
    }
    printf("\nTotal Profit: %d\n", totalProfit);
    printf("Number of loops: %d\n", loopCount);
    return 0;
}
