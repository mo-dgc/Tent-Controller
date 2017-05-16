#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import argparse
from mjpegtools import MjpegParser

def init():
	parser = argparse.ArgumentParser(description="MJPEG to Image")
	parser.add_argument("url", help="Stream URL")
	parser.add_argument("image", help="Name of image to save")
	args = parser.parse_args()

	main(args)


def main(args):
	image = MjpegParser(url=args.url).serve()
	with open(args.image, "wb") as im:
		im.write(image.output.read())


if __name__ == "__main__":
	init()
