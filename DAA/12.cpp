#include <stdio.h>
#include <stdlib.h>
typedef struct {
    int weight, profit;
    float ratio;
} Item;
int compare(const void* a, const void* b) {
    return ((Item*)b)->ratio > ((Item*)a)->ratio ? 1 : -1;
}
int main() {
    int capacity = 50;
    Item items[] = { {10, 60}, {20, 100}, {30, 120} };
    int n = sizeof(items) / sizeof(items[0]);
    float totalProfit = 0.0;
    int loopCount = 0;
    for (int i = 0; i < n; i++) {
        loopCount++;
        items[i].ratio = (float)items[i].profit / items[i].weight;
    }
    qsort(items, n, sizeof(Item), compare);
    loopCount++;
    for (int i = 0; i < n; i++) {
        loopCount++;
        if (capacity >= items[i].weight) {
            totalProfit += items[i].profit;
            capacity -= items[i].weight;
        } else {
            totalProfit += items[i].ratio * capacity;
            break;
        }
    }
    printf("Maximum Profit (Fractional Knapsack): %.2f\n", totalProfit);
    printf("Number of loops: %d\n", loopCount);
    return 0;
}
