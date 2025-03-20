# Use Python as base image
FROM python:3.10

# Set the working directory inside the container
WORKDIR /app

# Copy all files from your GitHub repo into the container
COPY . .

# Install dependencies (if required)
RUN pip install -r requirements.txt

# Run your application (modify as needed)
CMD ["python", "main.py"]
