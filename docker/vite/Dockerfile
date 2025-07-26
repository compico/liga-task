FROM node:24-alpine

RUN addgroup -g 82 www-data && adduser -u 1000 -G www-data -s /bin/sh -D appuser

WORKDIR /app

COPY package*.json ./

RUN npm ci --only=production

RUN chown -R appuser:node /app

USER node

EXPOSE 5173

CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]
