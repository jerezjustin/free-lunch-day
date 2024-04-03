FROM node:20

# Set working directory
WORKDIR /app

# Copy package json file that contains dependencies
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy the rest of the files
COPY . .

# Compile assets for production
RUN npm run build

EXPOSE 3000
CMD [ "npm", "run", "dev"]
