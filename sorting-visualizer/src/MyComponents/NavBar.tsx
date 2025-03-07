import { Button, HStack, Image, Text } from '@chakra-ui/react'
import logo from '../assets/react.svg'
import React from 'react'
import { useColorMode, useColorModeValue, ColorModeButton } from "../components/ui/color-mode"


interface Props {
    onChangeTheme: () => void;
  }


const NavBar = ({onChangeTheme}: Props) => {

  return (
    <HStack p="6" justifyContent='space-between'>
        <Image src={logo} boxSize='60px'/>
        {/* <Text>NavBar</Text> */}
        <ColorModeButton onClick={onChangeTheme}/>
    </HStack>
  )
}

export default NavBar