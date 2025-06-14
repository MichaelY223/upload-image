import os
import sys
from PIL import Image

#Convert file size to fitting units, assuming nothing smaller than 1kb and nothing greater than 999mb 
def format_bytes(size):
    for unit in ['KB', 'MB']:
        if size < 1024.0:
            return f"{size:.1f} {unit}"
        size /= 1024.0

def get_image_metadata(path):
    with Image.open(path) as img:
        print(f"File Name: {os.path.basename(path)}")
        print(f"File Size: {format_bytes(os.path.getsize(path))}")
        print(f"Dimensions: {img.width}x{img.height}")
        print(f"Format: {img.format}")
        print(f"Mode: {img.mode}")

if __name__ == '__main__':
    get_image_metadata(sys.argv[1])