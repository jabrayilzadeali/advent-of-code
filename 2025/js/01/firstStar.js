import fs from 'node:fs';
let data
try {
  data = fs.readFileSync('./data/input.txt', 'utf8');
} catch (err) {
  console.error(err);
}

const START = 50

const rotations = data.split('\n').filter(rotation => rotation && rotation !== "")

let password = 0
let dialPoint = START
for (const rotation of rotations) {
  const rotationNum = +rotation.substring(1)
  const degree = rotationNum > 100 ? rotationNum % 100 : rotationNum
  console.log('|dialPoint', dialPoint, 'Rotation', rotation,)
  if (rotation[0] === 'L') {
    dialPoint = degree > dialPoint ? 100 + (dialPoint - degree) : dialPoint - degree
    console.log('L', dialPoint)
  } else if (rotation[0] === 'R') {
    dialPoint = dialPoint + degree > 100 ? (dialPoint + degree) % 100 : dialPoint + degree
    console.log('R', dialPoint)
  }
  if (dialPoint >= 100) dialPoint = dialPoint % 100
  if (dialPoint === 0) password++
}
console.log(password)

