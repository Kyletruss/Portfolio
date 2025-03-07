import { List, ListItem } from '@chakra-ui/react';
import React from 'react';

interface Algorithm {
  name: string;
  id: number;
}

interface AlgorithmListProps {
  algorithms: Algorithm[];
  onSelectAlgorithm: (algorithm: number) => void;

}



const AlgorithmList: React.FC<AlgorithmListProps> = ({ algorithms, onSelectAlgorithm }) => {
  return (
    <List.Root >
      {algorithms.map((algorithm) => (
        <List.Item listStyleType="none" pb="4" _hover={{ 
            bg: "#252525", 
            color: " white", 
            borderRadius: "10px", 
            cursor: "pointer"}} 
            onClick={() => onSelectAlgorithm(algorithm.id)}
            key={algorithm.id}>{algorithm.name}
            </List.Item>
      ))}
    </List.Root>
  );
};

export default AlgorithmList;  // Make sure you're using default export
