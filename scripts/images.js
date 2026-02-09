import fs from 'fs'
import path from 'path'
import sharp from 'sharp'

const inputDir = 'src/img'
const outputDir = 'public/img'

fs.readdirSync(inputDir).forEach(async file => {

  const ext = path.extname(file)
  if (!['.jpg','.png'].includes(ext)) return

  const input = `${inputDir}/${file}`
  const name = path.parse(file).name

  // copiar original optimizado
  await sharp(input)
    .jpeg({ quality: 80 })
    .toFile(`${outputDir}/${file}`)

  // webp
  await sharp(input)
    .webp({ quality: 60 })
    .toFile(`${outputDir}/${name}.webp`)

  // avif
  await sharp(input)
    .avif({ quality: 50 })
    .toFile(`${outputDir}/${name}.avif`)
})
