#include<conio.h>
#include<stdio.h>
#define N 5
#define Dalpha 0.665
int main(){
	printf("Samyak Manandhar 79010513\n");
	float R[N] = {0.07,0.4,0.84,0.88,0.93};
	float X[N],Y[N],Z[N];
	float D1,D2,D;
	int i;
	for(i=1;i<=N;i++){
		X[i-1] = (double)i/N;		
	}
	for(i=1;i<=N;i++){
		Y[i-1] = (double)i/N-R[i-1];		
	}
	for(i=1;i<=N;i++){
		Z[i-1] = R[i-1]-(double)(i-1)/N;		
	}
	D1 = Y[0];
	for(i=1;i<N;i++)	{
		if(D1<Y[i])
		D1 = Y[i];
	}
	D2 = Z[0];
    for(i=1;i<N;i++){
		if(D1<Z[i])
		D1 = Z[i];
	}
	D = (D1>D2)?D1:D2;
	printf("D =  %0.2f",D);
	if(D<Dalpha)
	printf("\nRandom numbers are uniformally distributed\n");
	else
	printf("Random numbers are not uniformally distributed\n");
	
}
