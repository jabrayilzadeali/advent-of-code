import fs from 'node:fs';
let data
try {
  data = fs.readFileSync('./data/input.txt', 'utf8');
} catch (err) {
  console.error(err);
}

const rotations = data.split('\n').filter(rotation => rotation && rotation !== "")

function getPassword(startPos, rotations, min = 0, max = 99) {
  const LEN = max - min + 1
  let password = 0
  let dialPoint = startPos
  let prevDialPoint = null

  for (const rotation of rotations) {
    const rotationNum = +rotation.substring(1)
    if (rotationNum > LEN) password += Math.trunc(rotationNum / LEN)
    const degree = rotationNum > LEN ? rotationNum % LEN : rotationNum

    prevDialPoint = dialPoint
    if (rotation[0] === 'R') {
      if (dialPoint + degree >= LEN) {
        dialPoint = (dialPoint + degree) % 100
        if (dialPoint > min) {
          password++
        }
      } else {
        dialPoint += degree
      }
    } else if (rotation[0] === 'L') {
      if (dialPoint - degree <= min) {
        dialPoint = LEN + (dialPoint - degree)
        if (prevDialPoint && prevDialPoint !== min && dialPoint !== LEN) {
          password++
        }
      } else {
        dialPoint -= degree
      }
    }


    if (dialPoint === 100) dialPoint = 0
    if (dialPoint === 0) password++
    console.log(rotation, dialPoint, password)
  }
}

getPassword(50, rotations)
getPassword(55, ['L54'])

