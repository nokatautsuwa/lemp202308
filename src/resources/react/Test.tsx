import React from 'react'
import { createRoot } from 'react-dom/client'

function Test() {
  return (
    <>
      <p>
        Testテスト
      </p>
    </>
  )
}

export default Test;

const root = createRoot(
  document.getElementById('test') as HTMLElement
)
root.render(<Test />)