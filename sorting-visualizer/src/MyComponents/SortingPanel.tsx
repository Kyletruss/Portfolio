import React from 'react'

interface Algorithm {
    name: string;
    id: number;
  }
  
interface Props{
    selectedAlgorithm: Algorithm | undefined;
}

const SortingPanel = ({selectedAlgorithm}: Props) => {
  return (
    <div>
      {selectedAlgorithm ? (
        <h2>Selected Algorithm: {selectedAlgorithm.name} (ID: {selectedAlgorithm.id})</h2>
      ) : (
        <h2>No Algorithm Selected</h2>
      )}
    </div>
    

  )
}

export default SortingPanel