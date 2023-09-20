import React from 'react'
import { createRoot } from 'react-dom/client'

function About() {
  return (
    <>
      <p>
        Aboutテスト
      </p>
    </>
  )
}

export default About;

const root = createRoot(
  document.getElementById('about') as HTMLElement
)
root.render(<About />)