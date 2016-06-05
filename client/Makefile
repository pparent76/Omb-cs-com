CFLAGS=  $(shell curl-config --libs)
all:
	gcc main.c request.c $(CFLAGS) -o client
install:
	cp client /usr/bin/omb-client