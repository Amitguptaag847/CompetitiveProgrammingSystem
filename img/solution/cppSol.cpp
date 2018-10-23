#include<bits/stdc++.h>
using namespace std;
int64_t n,s,i,r,a[200000];
int main(){
	for(cin>>n>>s;i<n;i++)cin>>a[i];
	sort(a,a+n);
	if(a[n/2]<s){
		for(i=n/2;i<n;i++)if(a[i]<s)r+=s-a[i];
	}
	else{
		for(i=n/2;i>=0;i--)if(a[i]>s)r+=a[i]-s;
	}
	cout<<r;
}
